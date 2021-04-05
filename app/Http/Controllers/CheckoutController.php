<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller {
    public function index() {
        $cart = Session::get("cart");
        return view("checkout", [
            "cartItems" => $cart
        ]);
    }
}
