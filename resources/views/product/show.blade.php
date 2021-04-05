<?php
    if ($product->sub_cat->name === 'Suits' && $product->sub_cat->cat->name === 'Men') {
        $img_path = '/images/men-suit.png';
    } elseif ($product->sub_cat->name === 'Accessories' && $product->sub_cat->cat->name === 'Men') {
        $img_path = '/images/men-watch.png';
    } elseif ($product->sub_cat->name === 'Suits' && $product->sub_cat->cat->name === 'Women') {
        $img_path = '/images/women-suit.jpg';
    } else {
        $img_path = '/images/women-watch.jpg';
    }
?>
@extends('layouts.app')

@section('content')
    <section class="product-show my-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-4">
                    <div class="content">
                        <div class="product-img">
                            <img src="{{ $img_path }}" alt="" class="img-fluid w-100">
                            <div class="wishlist-container">
                                <a href="#" title="Add to Wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div>
                        <div class="breadcrumbs">
                            <a href="#">HOME</a> / <a href="#">PRODUCTS</a> / <a
                                href="#">{{ strtoupper($product->sub_cat->cat->name) }}</a> / <a
                                href="#">{{ strtoupper($product->sub_cat->name) }}</a>
                        </div>
                        <div class="heading">
                            <h1>{{ $product->name }}</h1>
                        </div>
                        <div class="price">
                            <h4><strong>${{ $product->price }}</strong></h4>
                        </div>
                        <div class="affirm">
                            <p>Starting at $55/mo with <strong>affirm</strong>. <a href="#">Learn more</a></p>
                        </div>
                        <div class="descripton">
                            <p>{{ $product->description }}</p>
                        </div>
                        <table width="295" class="mt-5">
                            <tbody>
                                <tr>
                                    <td width="135"><strong>Construction Type</strong></td>
                                    <td width="159">Half-Canvassed</td>
                                </tr>
                                <tr>
                                    <td width="135"><strong>Color</strong></td>
                                    <td width="159">Black</td>
                                </tr>
                                <tr>
                                    <td width="135"><strong>Design</strong></td>
                                    <td width="159">Solid</td>
                                </tr>
                                <tr>
                                    <td width="135"><strong>Fabric Composition</strong></td>
                                    <td width="159">95% Australian Merino Wool, 5% Cashmere</td>
                                </tr>
                                <tr>
                                    <td width="135"><strong>Weight</strong></td>
                                    <td width="159">Lightweight</td>
                                </tr>
                                <tr>
                                    <td width="135"><strong>Category </strong></td>
                                    <td width="159">Wool-Cashmere</td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <form action="#" method="get" onsubmit="return false">
                                <div class="d-flex my-5">
                                    <input type="button" value="-" class="btn-p" onclick="updateQuantity(this.value)">
                                    <input type="number" name="quantity" id="quantity" class="quantity-btn" min="1"
                                        value="1">
                                    <input type="button" value="+" class="btn-m" onclick="updateQuantity(this.value)">
                                    <button type="submit" onclick="addToCart({{ $product->id }})" class="btn btn-lg btn-primary ml-5" data-toggle="modal"
                                        data-target="#exampleModal"><strong>ADD TO CART</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Your Cart</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="row justify-content-center">
                                <div class="col-10 p-0">
                                    <div id="cartItems">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="mx-auto">
                        <a href="{{ route("cart.show") }}" class="btn btn-secondary">View Cart</a>
                        <a href="{{ route("checkout") }}" class="btn btn-primary">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
