<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PayPalController extends Controller
{
    public function createPayment(Request $request)
    {
        DB::transaction(function () use ($request) {
            $Id = $request->query('Id');
            $listing = Listing::find($Id);
            $userid = $listing->user_id;

            $user = User::find($userid);
            $user->cash += round(($listing->price) / 2, 2);
            $user->save();

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->setAccessToken($provider->getAccessToken());

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $Id
                        ]
                    ]
                ],
                "application_context" => [
                    "return_url" => route('paypal.capturePayment')

                ]
            ]);

            if (isset($response['id']) && $response['status'] == 'CREATED') {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }
        });

        return redirect()->route('error');
    }

    public function capturePayment(Request $request)
    {
        DB::transaction(function () use ($request) {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->setAccessToken($provider->getAccessToken());

            $response = $provider->capturePaymentOrder($request->query('token'));

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {


                return redirect()->route('index');
            }
        });



    }
    public function sendPayout(Request $request)
    {
        DB::transaction(function () use ($request) {


            $user = User::find(Auth::id());
            #dd($user);

            $amount = $user->cash;
            $user->cash = 0;
            $user->save();

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $accessToken = $provider->getAccessToken();
            $provider->setAccessToken($accessToken);

            $payoutData = [
                "sender_batch_header" => [
                    "email_subject" => "You have a payout!",
                ],
                "items" => [
                    [
                        "recipient_type" => "EMAIL",
                        "amount" => [
                            "value" => number_format($amount, 2, '.', ''),
                            "currency" => "USD"
                        ],
                        "receiver" => $user->email,
                        "note" => "Thank you for using our service!",
                        "sender_item_id" => uniqid()
                    ]
                ]
            ];

            $response = $provider->createBatchPayout($payoutData);

            if (isset($response['batch_header']['payout_batch_id'])) {
                return response()->json([
                    'success' => true,
                    'payout_batch_id' => $response['batch_header']['payout_batch_id']
                ]);
            } else {
                return response()->json(['error' => 'Payout failed.', 'details' => $response], 500);
            }

        });
    }




}
