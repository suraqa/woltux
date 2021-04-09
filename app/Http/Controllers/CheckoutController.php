<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class CheckoutController extends Controller {

    public function index() {

        Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

        $intent = Stripe\PaymentIntent::create([
            "amount" => 2000 * 100,
            "currency" => "pkr",
            "payment_method_types" => ["card"]
        ]);

        $cart = Session::get("cart");
        return view("checkout", [
            "cartItems" => $cart,
            "client_secret" => $intent->client_secret
        ]);

    }

    public function checkout(Request $request) {


        // Stripe\Charge::create([
        //     'amount' => 200000,
        //     'currency' => 'usd',
        //     'source' => 'tok_visa',
        //     'description' => 'My First Test Charge (created for API docs)',
        //   ]);

        return $request;

































    }
}
