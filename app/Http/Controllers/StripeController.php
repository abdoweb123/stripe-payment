<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{


    /** checkout page **/
    public function checkout()
    {
        return view('checkout');
    }


    /** payment method **/
    public function session(Request $request)
    {

        try {
            Stripe::setApiKey(config('stripe.sk'));

            $productname = $request->get('productname');
            $totalprice = $request->get('total');
            $two0 = "00";
            $total = "$totalprice$two0";

            $session = Session::create([
                'line_items'  => [
                    [
                        'price_data' => [
                            'currency'     => 'USD',
                            'product_data' => [
                                "name" => $productname,
                            ],
                            'unit_amount'  => $total,
                        ],
                        'quantity'   => 1,
                    ],

                ],
                'mode'        => 'payment',
                'success_url' => route('success'),
                'cancel_url'  => route('checkout'),
            ]);


            return redirect()->away($session->url);
        }
        catch (\Exception $e){

            return response()->json(['error'],500);
        }


    }

    public function success()
    {
        return "Thanks for your order You have just completed your payment. The seeler will reach out to you as soon as possible";
    }
}
