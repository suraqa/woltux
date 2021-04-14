<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller {

    public function index() {
        $wishlist = Session::get("wishlist");
        return view("wishlist", [
            "wishlist" => $wishlist,
        ]);
    }

    public function add(Product $product) {
        $wishlist = Session::get("wishlist");
        $cart = Session::get("cart");

        // if wishlist is empty
        if(!$wishlist) {
            $wishlist = [
                $product->id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                ]
            ];
            Session::put("wishlist", $wishlist);
        }

        if (empty($wishlist) && !array_key_exists($product["id"], $cart) && !array_key_exists($product["id"], $wishlist)) {
            $wishlist = [
                $product->id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                ]
            ];
            Session::put("wishlist", $wishlist);
        }

        // if product doesnt exist in cart
        if(!array_key_exists($product["id"], $cart) && !array_key_exists($product["id"], $wishlist)) {
            $wishlist[$product["id"]] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
            ];
            Session::put("wishlist", $wishlist);
        }
    }

    public function update(Product $product, Request $request) {
        $wishlist = Session::get("wishlist");
        $wishlist[$product["id"]]["quantity"] = $request["quantity"];
        Session::put("wishlist", $wishlist);
        return Session::get("wishlist");
    }

    public function addToCart(Product $product, Request $request) {
        CartController::add($request, $product);
        $wishlist = Session::get("wishlist");
        foreach ($wishlist as $p_id => $details) {
            if ($p_id == $product["id"]) {
                unset($wishlist[$product["id"]]);
            }
        }
        Session::put("wishlist", $wishlist);
        return Session::get("wishlist");
    }

    public function addAlltoCart() {
        $wishlist = Session::get("wishlist");
        $cart = Session::get("cart");

        foreach($wishlist as $p_id => $details) {
            $cart[$p_id] = [
                "name" => $details["name"],
                "quantity" => $details["quantity"],
                "price" => $details["price"],
            ];
        }
        Session::put("cart", $cart);
        Session::put("wishlist", []);

        return Session::get("cart");
    }

    public function delete(Product $product) {
        $wishlist = Session::get("wishlist");

        foreach($wishlist as $p_id => $details) {
            if($product["id"] == $p_id) {
                unset($wishlist[$product["id"]]);
            }
        }
        Session::put("wishlist", $wishlist);
    }

    public function deleteAll() {
        Session::forget("wishlist");
    }

}
