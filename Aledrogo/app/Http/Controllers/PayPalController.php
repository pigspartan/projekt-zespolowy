<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayPalController extends Controller
{
    public function createPayment(Request $request)
    {

        $Id = $request->query('Id');

        $listing = Listing::find($Id);

        if ($listing->status == 'reserved' || $listing->status == 'sold'){
            return back()->withErrors(['msg' => 'Listing jest zarezerwowany przez inną transakcję, lub został sprzedany']);
        }

        DB::table('listings')->where('id',$Id)->update(['status' => 'reserved']);



        $userid = $listing->user_id;

        $user = User::find($userid);
        $user->cash += round(($listing->price) / 2, 2);
        $user->save();

        $transaction = Transaction::create([
            'listing_id' => $Id,
            'buyer_id' =>Auth::id(),
            'seller_id' =>$userid,
            'amount' => $listing->price,
        ]);

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
                "return_url" => route('paypal.capturePayment',['listing_id' => $Id, 'transaction_id' => $transaction->id]),
            ]
        ]);


        if (isset($response['id']) && $response['status'] == 'CREATED') {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }


        return redirect()->route('error');
    }

    public function capturePayment(Request $request)
    {

        $listingId = $request->query('listing_id');
        $transactionId = $request->query('transaction_id');

        DB::table('listings')->where('id',$listingId)->update(['status' => 'sold']);
        DB::table('transactions')->where('id',$transactionId)->update(['paid_at' => date('d M Y H:i:s')]);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());

        $response = $provider->capturePaymentOrder($request->query('token'));
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {


            return redirect()->route('index');
        }
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
