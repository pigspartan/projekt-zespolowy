<?php

namespace App\Http\Controllers;

use App\Jobs\ChangeListingStatusJob;
use App\Models\Listing;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PayPalController extends Controller
{
    public function createPayment(Request $request)
    {

        $Id = $request->query('Id');

        $listing = Listing::find($Id);

        if ($listing->status == 'reserved' || $listing->status == 'sold') {
            return back()->withErrors(['msg' => 'Listing jest zarezerwowany przez inną transakcję, lub został sprzedany']);
        }

        DB::table('listings')->where('id', $Id)->update(['status' => 'reserved']);
        ChangeListingStatusJob::dispatch($Id)->delay(now()->addMinutes(5));


        $userid = $listing->user_id;

        $user = User::find($userid);
        $user->cash += round(($listing->price) / 2, 2);
        $user->save();

        $transaction = Transaction::create([
            'listing_id' => $Id,
            'buyer_id' => Auth::id(),
            'seller_id' => $userid,
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
                        "value" => $listing->price
                    ]
                ]
            ],
            "application_context" => [
                "return_url" => route('paypal.capturePayment', ['listing_id' => $Id, 'transaction_id' => $transaction->id]),
                "cancel_url" => route('paypal.cancelPayment', ['listing_id' => $Id, 'transaction_id' => $transaction->id]), // Redirect if payment is canceled
            ]
        ]);


        if (isset($response['id']) && $response['status'] == 'CREATED') {

            DB::table('transactions')->where('id',$transaction->id)->update(['payment_id' => $response['id'], 'status' => $response['status']]);
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

        DB::table('listings')->where('id', $listingId)->update(['status' => 'sold']);
        DB::table('transactions')->where('id', $transactionId)->update(['paid_at' => date('d M Y H:i:s')]);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());

        $response = $provider->capturePaymentOrder($request->query('token'));
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            DB::table('transactions')->where('id', $transactionId)->update(['status' => $response['status']]);
            return redirect()->route('index');
        }
    }

    public function cancelPayment(Request $request)
    {
        // Retrieve the listing ID from the request if applicable
        $listingId = $request->query('listing_id');
        $transactionId = $request->query('transaction_id');
        if ($listingId) {
            $listing = Listing::find($listingId);
            if ($listing) {
                DB::table('listings')->where('id', $listingId)->update(['status' => 'available']);
                DB::table('transactions')->where('id', $transactionId)->update(['status' => 'CANCELLED']);
            }
        }
        // Optionally, log the cancellation or show a message to the user
        Log::info('Payment canceled', ['listing_id' => $listingId, 'user_id' => Auth::id()]);

        return redirect()->route('index')->with('error', 'The payment was canceled. Please try again.');
    }

    public function resumePayment($listingId,$transactionId)
{
    $listing = Listing::find($listingId);
    $transaction = Transaction::find($transactionId);

    if (!$listing || !$transaction->payment_id) {
        return redirect()->route('index')->with('message', 'No payment session found.');
    }

    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $provider->setAccessToken($provider->getAccessToken());

    // Fetch the order details
    $response = $provider->showOrderDetails($transaction->payment_id);

    if (isset($response['status']) && $response['status'] == 'CREATED') {
        DB::table('transactions')->where('id',$transaction->id)->update(['payment_id' => $response['id'], 'status' => $response['status']]);

        // Redirect the user to PayPal approval URL
        foreach ($response['links'] as $link) {
            if ($link['rel'] === 'approve') {
                return redirect()->away($link['href']);
            }
        }
    }

    return redirect()->route('index')->with('message', 'Payment cannot be resumed.');
}



    public function sendPayout(Request $request)
    {
        DB::transaction(function () use ($request) {


            $user = User::find(Auth::id());

            $amount = $user->cash;

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
                $user->cash = 0;
                $user->save();
            } else {
                return response()->json(['error' => 'Payout failed.', 'details' => $response], 500);
            }

        });
    }
}
