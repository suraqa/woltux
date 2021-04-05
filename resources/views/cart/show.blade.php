@extends("layouts.app")

@section('content')
    <section class="cart-show my-5">
        <div class="container">
            <div class="breadcrumbs text-center">
                <h3>
                    <a href="#">SHOPPING CART</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a
                        href="#">CHECKOUT DETAILS</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a
                        href="#">ORDER COMPLETE</a>
                </h3>
            </div>

            @if (!empty($cartItems))
                <div class="row my-5">
                    <div class="col-8 table-left">
                        <table class="table" id="table-left">
                            <thead>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th>PRICE</th>
                                    <th>QUANTITY</th>
                                    <th>SUBTOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; ?>
                                @foreach ($cartItems as $p_id => $p_details)
                                    <?php
                                        $total += $p_details["price"] * $p_details["quantity"];
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div>
                                                    <a href="#" onclick="deleteCart({{ $p_id }})" class="text-danger"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
                                                </div>
                                                <div class="ml-3">
                                                    <h4>
                                                        <strong>{{ strtoupper($p_details["name"]) }}</strong>
                                                    </h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td><strong> $ {{ $p_details["price"] }}</strong></td>
                                        <td>
                                            <div class="d-flex">
                                                <input type="button" value="-" class="btn-p" onclick="updateCart(this.value, {{ $p_id }})">
                                                <input type="number" name="quantity" id="quantity-{{ $p_id }}" class="quantity-btn" min="1"
                                                    value={{ $p_details["quantity"] }}>
                                                <input type="button" value="+" class="btn-m" onclick="updateCart(this.value, {{ $p_id }})">
                                            </div>
                                        </td>
                                        <td>
                                            <strong>
                                                 $ <span id="subtotal-{{ $p_id }}">
                                                    {{ $p_details["price"] * $p_details["quantity"] }}
                                                    </span>
                                            </strong>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- <tr class="total">
                                    <td><h4><strong>Total</strong></h4></td>
                                    <td></td>
                                    <td></td>
                                    <td><h5><strong> $ <span id="total">{{ $total }}</span></strong></h5></td>
                                </tr> --}}
                                <tr class="continue">
                                    <td scope="column">
                                        <div class="text-center py-5">
                                            <a href="#" class="btn btn-primary btn-lg">Continue shopping</a>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <table class="table" id="table-right">
                            <thead>
                                <tr>
                                    <th>CART TOTALS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SUB TOTAL</td>
                                    <td class="text-right"><strong> $ <span id="total">{{ $total }}</span></strong></td>
                                </tr>
                                <tr class="d-none">
                                    <td></td>
                                    <td class="text-right"></td>
                                </tr>
                                <tr class="last">
                                    <td>TOTAL</td>
                                    <td class="text-right"><strong>32132</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right">
                            <p>Starting at $107/mo with <strong>affirm</strong>. <a href="#">Learn more</a></p>
                        </div>
                        <hr>
                        <div>
                            <a href="#" class="btn btn-lg btn-primary w-100">PROCEED TO CHECKOUT</a>
                        </div>
                        <div class="my-5">
                            <form action="#" method="post">
                                <div>
                                    <label for="coupon">
                                        <i class="fa fa-tag" aria-hidden="true"></i> <strong>Coupon</strong>
                                    </label>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <input type="text" name="coupon" id="coupon" class="form-control" placeholder="Promo Code">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-lg w-100">Apply Code</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center my-5">
                    <h1>Your cart is empty!!</h1>
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
