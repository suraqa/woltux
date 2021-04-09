@extends("layouts.app")
{{-- {{ dd($cartItems) }} --}}
@section('content')
    <section class="checkout my-5">
        <div class="container">
            <div class="breadcrumbs text-center">
                <h3>
                    <a href="#">SHOPPING CART</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a
                        href="#">CHECKOUT DETAILS</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a
                        href="#">ORDER COMPLETE</a>
                </h3>
            </div>

            <form method="post" id="payment-form">
                @csrf
                <input type="hidden" id="stripe-key" value="{{ env("STRIPE_KEY") }}">
                <input type="hidden" id="client-secret" value="{{ $client_secret }}">
                <div class="row my-4">
                    <div class="col-7">
                        <div class="left-side my-3 py-2">
                            <div class="my-3">
                                <h4><strong>BILLING DETAILS</strong></h4>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="f-name"><strong>First name <span
                                                            class="text-danger">*</span></strong></label>
                                            </div>
                                            <div class="col-12">
                                                <input type="text" name="first-name" id="f-name" class="form-control"
                                                    >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="l-name"><strong>Last name <span
                                                            class="text-danger">*</span></strong></label>
                                            </div>
                                            <div class="col-12">
                                                <input type="text" name="last-name" id="l-name" class="form-control"
                                                    >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="company"><strong>Company</strong></label>
                                        <input type="text" class="form-control" id="company" name="company">
                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="country"><strong>Country <span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="text" class="form-control" id="country" value="Pakistan" readonly
                                            name="country">
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label for="address"><strong>Street Address <span
                                                    class="text-danger">*</span></strong></label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control" id="address"
                                                    placeholder="House number and street name"  name="address-1">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control"
                                                    placeholder="Apartment, suite, unit, etc. (optional)"
                                                    name="address-2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="city"><strong>City <span class="text-danger">*</span></strong></label>
                                        <input type="text" class="form-control" id="city"  name="city">
                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="phone"><strong>Phone <span class="text-danger">*</span></strong></label>
                                        <input type="tel" class="form-control" id="phone" pattern="[0-9]{4}-[0-9]{7}"
                                            placeholder="03xx-xxxxxxx"  name="phone">
                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="email"><strong>Email Address <span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="email" class="form-control" id="email"  name="email">
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <input type="checkbox" name="create-acc" value="true" id="acc" onchange="abc(this)"> <label
                                            for="acc"><strong>Create an account ?</strong></label>
                                    </div>
                                </div>
                                <div class="password-hide">
                                    <div class="form-group">
                                        <label for="pass"><strong>Password <span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="password" name="password" id="pass" class="form-control" autocomplete="new-password">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-5">
                        <div class="right-side my-3 px-4 py-4">
                            <div>
                                <h4><strong>YOUR ORDER</strong></h4>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT</th>
                                            <th class="text-right">SUB-TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0; ?>
                                        @foreach ($cartItems as $p_id => $item)
                                            <?php $total += $item['quantity'] * $item['price']; ?>
                                            <tr>
                                                <td>{{ strtoupper($item['name']) }} <strong>x
                                                        {{ $item['quantity'] }}</strong></td>
                                                <td class="text-right"><strong> $
                                                        {{ $item['quantity'] * $item['price'] }}</strong></td>
                                            </tr>
                                        @endforeach
                                        <tr class="sub-total">
                                            <td><strong>Subtotal</strong></td>
                                            <td class="text-right"><strong> $ {{ $total }}</strong></td>
                                        </tr>
                                        <tr class="total">
                                            <td><strong>Total</strong></td>
                                            <td class="text-right"><strong> $ {{ $total }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <p class="muted">Pay with your Debit/Credit card</p>

                                <div class="form-group">
                                    <label for="card-element"><strong>Card Number <span class="text-danger">*</span></strong></label>
                                    <div id="card-element" class="form-control"></div>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="card-exp"><strong>Expiry Date <span class="text-danger">*</span></strong></label>
                                    <div id="card-exp" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label for="card-cvc"><strong>Card Code (CVC) <span class="text-danger">*</span></strong></label>
                                    <div id="card-cvc" class="form-control"></div>
                                </div> --}}
                                {{-- <div id="card-element"></div> --}}
                                {{-- <a class="btn btn-primary" href="#" onclick="placeOrder()">PLACE ORDER</a> --}}
                                <button type="submit" class="btn btn-primary">PLACE ORDER</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>

            {{-- <div class="my-5">
                <input id="card-holder-name" type="text">

                <!-- Stripe Elements Placeholder -->
                <div id="card-element"></div>

                <button id="card-button">
                    Process Payment
                </button>
            </div> --}}
            {{-- <div class="row my-4">
                <div class="col-7">
                    <div class="left-side my-3 py-2">
                        <div class="my-3">
                            <h4><strong>BILLING DETAILS</strong></h4>
                            <form action="#" method="post" class="my-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="f-name"><strong>First name <span class="text-danger">*</span></strong></label>
                                            </div>
                                            <div class="col-12">
                                                <input type="text" name="first-name" id="f-name" class="form-control"   >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="l-name"><strong>Last name <span class="text-danger">*</span></strong></label>
                                            </div>
                                            <div class="col-12">
                                                <input type="text" name="last-name" id="l-name" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="company"><strong>Company</strong></label>
                                        <input type="text" class="form-control" id="company">
                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="country"><strong>Country <span class="text-danger">*</span></strong></label>
                                        <input type="text" class="form-control" id="country" value="Pakistan" readonly>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label for="address"><strong>Street Address <span class="text-danger">*</span></strong></label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control" id="address" placeholder="House number and street name" >
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="city"><strong>City <span class="text-danger">*</span></strong></label>
                                        <input type="text" class="form-control" id="city" >
                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="phone"><strong>Phone <span class="text-danger">*</span></strong></label>
                                        <input type="tel" class="form-control" id="phone" pattern="[0-9]{4}-[0-9]{7}" placeholder="03xx-xxxxxxx" >
                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="email"><strong>Email Address <span class="text-danger">*</span></strong></label>
                                        <input type="email" class="form-control" id="email" >
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <input type="checkbox" name="" id="acc" onchange="abc(this)"> <label for="acc"><strong>Create an account ?</strong></label>
                                    </div>
                                </div>
                                <div class="password-hide">
                                    <div class="form-group">
                                        <label for="pass"><strong>Password <span class="text-danger">*</span></strong></label>
                                        <input type="password" name="password" id="pass" class="form-control">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                <div class="col-5">
                    <div class="right-side my-3 px-4 py-4">
                        <div>
                            <h3>YOUR ORDER</h3>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>PRODUCT</th>
                                        <th class="text-right">SUB-TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0; ?>
                                    @foreach ($cartItems as $p_id => $item)
                                        <?php $total += $item['quantity'] * $item['price']; ?>
                                        <tr>
                                            <td>{{ strtoupper($item["name"]) }} <strong>x {{ $item["quantity"] }}</strong></td>
                                            <td class="text-right"><strong> $ {{ $item["quantity"] * $item["price"] }}</strong></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td><strong>Subtotal</strong></td>
                                        <td class="text-right"><strong> $ {{ $total }}</strong></td>
                                    </tr>
                                    <tr class="total">
                                        <td><strong>Total</strong></td>
                                        <td class="text-right"><strong> $ {{ $total }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>

                            <p class="muted">Pay with your Debit/Credit card</p>

                            <form action="" method="post"></form>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

@endsection
