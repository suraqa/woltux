<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get("cart");
        return view("checkout", [
            "cartItems" => $cart
        ]);
    }

    public function checkout(Request $request) {

        Stripe\Stripe::setApiKey("sk_test_51IRhvAKkz2PvTdyxiy8MgzsK06jaj33uNYgu6WuwJdWniZENPi5MyimrYhzysrjfmfgpm5GkMQbqlRLZzWSzNA0s005UAKwTLA");

        // Stripe\Charge::create([
        //     'amount' => 200000,
        //     'currency' => 'usd',
        //     'source' => 'tok_visa',
        //     'description' => 'My First Test Charge (created for API docs)',
        //   ]);

        return $request;

































    }
}
