@extends('layouts.app')

@section('content')
    {{-- {{ dd($products[1]->sub_cat->cat->name) }} --}}
    <section class="popular-products my-5 py-5">
        <div class="container">
            <div class="heading text-center">
                <h1>OUR MOST POPULAR PRODUCTS</h1>
                <div class="underline mx-auto"></div>
            </div>
            <div class="row my-5">
                @foreach ($products as $product)
                    <div class="col-3 my-4">
                        <div class="card shadow">
                            <a href="{{ route("product.show", $product->id) }}">
                                <img class="card-img-top" src="
                                <?php
                                    if($product->sub_cat->name === "Suits" && $product->sub_cat->cat->name === "Men") {echo "/images/men-suit.png";}
                                    else if ($product->sub_cat->name === "Accessories" && $product->sub_cat->cat->name === "Men") {echo "/images/men-watch.png";}
                                    else if ($product->sub_cat->name === "Suits" && $product->sub_cat->cat->name === "Women") {echo "/images/women-suit.jpg";}
                                    else {echo "/images/women-watch.jpg";}
                                ?>" alt="">
                            </a>
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ $product->sub_cat->name }}</h4>
                                <p class="card-text">
                                    <a href="{{ route("product.show", $product->id) }}">{{ $product->name }}</a>
                                </p>
                                <p class="card-text">
                                    <s class="text-danger mr-3"><span class="text-primary">$ {{ $product->price + 1000 }}</span></s> <strong>$ {{ $product->price }}.</strong>
                                </p>
                            </div>
                            <div class="wishlist-container">
                                <a href="" title="Add to Wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
