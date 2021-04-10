<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class CheckoutController extends Controller {

    public function index() {

        $cart = Session::get("cart");

        $total = 0;
        foreach($cart as $p_id => $details) {
            $total += $details["quantity"] * $details["price"];
        }

        Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

        $intent = Stripe\PaymentIntent::create([
            "amount" => $total * 100,
            "currency" => "usd",
            "payment_method_types" => ["card"]
        ]);

        return view("checkout", [
            "cartItems" => $cart,
            "client_secret" => $intent->client_secret
        ]);

    }

    public function checkout(Request $request) {

        // dd($request);

    }
}
