@extends("layouts.app")
@section('content')
    <section class="wishlist-section my-5">
        <div class="container">
            <div class="breadcrumbs text-center">
                <h3>
                    <a href="#">HOME</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a
                        href="#">WISHLIST</a>
                </h3>
            </div>

            @if (!empty($wishlist))
                <div class="my-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>PRODUCT</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlist as $p_id => $details)
                                <tr>
                                    <td>{{ $details["name"] }}</td>
                                    <td>{{ $details["price"] }}</td>
                                    <td>{{ $details["quantity"] }}</td>
                                    <td>{{ $details["price"] * $details["quantity"] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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


@endsection
