@extends("layouts.app")
{{-- {{ dd($wishlist) }} --}}
@section('content')
    <section class="wishlist-section my-5">
        <div class="container">
            <div class="breadcrumbs text-center">
                <h3>
                    <a href="#">HOME</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="#">WISHLIST</a>
                </h3>
            </div>

            @if (!empty($wishlist))
                <div class="my-5">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="alert alert-success text-center" role="alert">
                                <strong>Added to Cart!!</strong>
                            </div>
                        </div>
                    </div>
                    <div id="table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th>PRICE</th>
                                    <th>QUANTITY</th>
                                    <th>SUBTOTAL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlist as $p_id => $details)
                                    <tr>
                                        <td><strong>{{ strtoupper($details["name"]) }}</strong></td>
                                        <td><strong> $ {{ $details["price"] }}</strong></td>
                                        <td>
                                            <div class="d-flex">
                                                <input type="button" value="-" class="btn-p" onclick="updateWL(this.value, {{ $p_id }})">
                                                <input type="number" name="quantity" id="quantity-{{ $p_id }}" class="quantity-btn" min="1"
                                                    value={{ $details["quantity"] }}>
                                                <input type="button" value="+" class="btn-m" onclick="updateWL(this.value, {{ $p_id }})">
                                            </div>
                                        </td>
                                        <td><strong> $ <span id="subtotal-{{ $p_id }}">{{ $details["price"] * $details["quantity"] }}</span></strong></td>
                                        <td>
                                            <div class="d-flex">
                                                <div>
                                                    <button onclick="addWLtoCart({{ $p_id }})" class="btn btn-primary">Add to cart</button>
                                                </div>
                                                <div class="ml-2">
                                                    <button onclick="deleteWL({{ $p_id }})" class="btn btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-5">
                        <button onclick="addAllWLtoCart()" class="btn btn-lg btn-primary">Add all to Cart</button>
                        <button onclick="deleteAllWL()" class="btn btn-lg btn-danger ml-2">Delete all</button>
                    </div>
                </div>
            @else
                <div class="text-center my-5">
                    <h1>Your wishlist is empty!!</h1>
                </div>
                <div class="text-center py-5">
                    <a href="#" class="btn btn-primary btn-lg">Return to Shop</a>
                </div>
            @endif
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
                        <a href="" class="btn btn-primary">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
