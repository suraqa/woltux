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
        // Session::forget("wishlist");
        $wishlist = Session::get("wishlist");

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
        // if wishlist is not empty & does not contain same product
        else if(array_search($product->id, $wishlist) === false) {
            $wishlist[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
            ];
            Session::put("wishlist", $wishlist);
        }
        return $wishlist;
    }

}
