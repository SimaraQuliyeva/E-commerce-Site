@extends('front.layout.layout')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{route('front.index')}}">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Cart</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row mb-5">
{{--                <form class="col-md-12" method="post">--}}
                    <div class=" col-lg-12 site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($cartItem)
                                @foreach($cartItem as $key=> $cart)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="{{asset($cart['image']) }}" alt="Image" class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{$cart['name'] ?? '' }}</h2>
                                        </td>
                                        <td>{{$cart['price'] }}</td>
                                        <td>
                                            <div class="input-group mb-3" style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-primary js-btn-minus" type="button">
                                                        &minus;
                                                    </button>
                                                </div>
                                                <input type="text" class="form-control text-center"
                                                       value="{{$cart['quantity']}}" placeholder=""
                                                       aria-label="Example text with button addon"
                                                       aria-describedby="button-addon1">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary js-btn-plus" type="button">
                                                        &plus;
                                                    </button>
                                                </div>
                                            </div>

                                        </td>
                                        <td>$ {{$cart['price'] * $cart['quantity'] }}</td>
                                        <td>
                                            <form action="{{route('front.cart.delete') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="productId" value="{{$key}}">
                                                <button type="submit" class="btn btn-primary btn-sm">X</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
{{--                </form>--}}
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-primary btn-sm btn-block">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Coupon</label>
                            <p>Enter your coupon code if you have one.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-sm">Apply Coupon</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">$ {{$totalPrice}}</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-lg py-3 btn-block"
                                            onclick="window.location='checkout.html'">Proceed To Checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
