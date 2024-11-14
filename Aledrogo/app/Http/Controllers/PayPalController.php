<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;

class PayPalController extends Controller
{
    public function createPayment(Request $request)
    {
        $price = $request->query('price');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $price
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

        return redirect()->route('error');
    }

    public function capturePayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());

        $response = $provider->capturePaymentOrder($request->query('token'));

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            return redirect()->route('index');
        }


    }
}
