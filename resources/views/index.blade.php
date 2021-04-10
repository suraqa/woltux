@extends('layouts.app')

@section('content')
    <section class="popular-products my-5 py-5">
        <div class="container">
            <div class="heading text-center">
                <h1>OUR MOST POPULAR PRODUCTS</h1>
                <div class="underline mx-auto"></div>
            </div>

            <div class="row my-5">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="alert alert-success text-center d-none" role="alert">
                                <strong>Added to Wishlist!!</strong>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($products as $product)
                    <div class="col-3 my-4">
                        <div class="card shadow">
                            <a href="{{ route('product.show', $product->id) }}">
                                <img class="card-img-top" src="
                                    <?php if ($product->sub_cat->name === 'Suits' && $product->sub_cat->cat->name === 'Men') {
                                        echo '/images/men-suit.png';
                                    } elseif ($product->sub_cat->name === 'Accessories' && $product->sub_cat->cat->name === 'Men') {
                                        echo '/images/men-watch.png';
                                    } elseif ($product->sub_cat->name === 'Suits' && $product->sub_cat->cat->name === 'Women') {
                                        echo '/images/women-suit.jpg';
                                    } else {
                                        echo '/images/women-watch.jpg';
                                    } ?>" alt="">
                            </a>
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ $product->sub_cat->name }}</h4>
                                <p class="card-text">
                                    <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                </p>
                                <p class="card-text">
                                    <s class="text-danger mr-3"><span class="text-primary">$
                                            {{ $product->price + 1000 }}</span></s> <strong>$
                                        {{ $product->price }}.</strong>
                                </p>
                            </div>
                            <div class="wishlist-container">
                                <a onclick="addToWL({{ $product->id }})" title="Add to Wishlist"><i
                                        class="fa fa-heart" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Cart</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                        <a href="{{ route('cart.show') }}" class="btn btn-secondary">View Cart</a>
                        <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
