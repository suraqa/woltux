<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {
    public function add(Request $request, Product $product) {
        $cart = session()->get("cart");
        // if cart is empty
        if(!$cart) {
            $cart = [
                $product->id => [
                    "name" => $product->name,
                    "quantity" => $request["quantity"],
                    "price" => $product->price,
                ]
            ];
            session()->put('cart', $cart);
            return Session::get("cart");
        }
        // if cart not empty but the product exists
        if(isset($cart[$product->id])) {
            $cart[$product->id]["quantity"] += $request["quantity"];
            session()->put('cart', $cart);
            return Session::get("cart");
        }
        // if cart not empty & the product doesnt exist
        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => $request["quantity"],
            "price" => $product->price,
        ];
        session()->put("cart", $cart);
        return Session::get("cart");
    }

    public function getCartItems() {
        return Session::get("cart");
    }

    public function deleteCartItem(Product $product) {
        $cartItems = Session::get("cart");
        foreach($cartItems as $p_id => $items ) {
            if($p_id == $product->id) {
                unset($cartItems[$p_id]);
                // return "1";
            }
        }
        Session::put("cart", $cartItems);
        return "done";
    }

    public function showCart() {
        $cartItems = Session::get("cart");
        return view("cart.show", [
            "cartItems" => $cartItems
        ]);
    }

    public function update(Product $product, Request $request) {
        $cartItems = Session::get("cart");
        $cartItems[$product->id]["quantity"] = $request["quantity"];
        Session::put("cart", $cartItems);
        return Session::get("cart");
    }










































    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Session::get();
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
