<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view("index", [
            "products" => Product::take(4)->latest()->get(),
            // "cart" => Cart::latest()->get()
        ]);
    }
}
