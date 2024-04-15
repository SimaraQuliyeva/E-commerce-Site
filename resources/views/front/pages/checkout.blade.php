@extends('front.layout.layout')
@section('content')
    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                        Returning customer? <a href="#">Click here</a> to login
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <form action="{{route('front.cart.save')}}" method="post">
                        @csrf
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group">
                            <label for="country" class="text-black">Country <span class="text-danger">*</span></label>
                            <select id="country" name="country" class="form-control">
                                <option value="">Select a country</option>
                                <option value="az" selected>Azerbaijan</option>
                                <option value="3">Algeria</option>
                                <option value="4">Turkey</option>
                                <option value="5">Russia</option>
                                <option value="6">Albania</option>
                                <option value="7">Bahrain</option>
                                <option value="8">Colombia</option>
                                <option value="9">Dominican Republic</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="text-black">First Name and Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="companyName" class="text-black">Company Name </label>
                                <input type="text" class="form-control" id="companyName" name="companyName">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="address" class="text-black">Address <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" id="address" name="address" placeholder="Street address"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="city" class="text-black">City<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                            <div class="col-md-6">
                                <label for="postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="postal_zip" name="postal_zip">
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label for="email" class="text-black">Email Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="notes" class="text-black">Order Notes</label>
                            <textarea name="notes" id="notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                        </div>
                    </div>
                    </div>
                <div class="col-md-6">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                    <th>Product</th>
                                    <th>Total</th>
                                    </thead>
                                    <tbody>
                                    @php
                                        $totalPrice=0;
                                    @endphp
                                    @if(session()->get('cart'))
                                        @foreach(session()->get('cart') as $key=>$cart)
                                            @php
                                                $totalPrice+=($cart['price'] * $cart['quantity'])
                                            @endphp
                                            <tr>
                                                <td>{{$cart['name']}} <strong class="mx-2">x</strong>{{$cart['quantity']}}</td>
                                                <td>${{$cart['price']}}</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                        <td class="text-black font-weight-bold"><strong>${{$totalPrice}}</strong></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                                    <div class="collapse" id="collapsebank">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                                    <div class="collapse" id="collapsecheque">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border p-3 mb-5">
                                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                                    <div class="collapse" id="collapsepaypal">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='thankyou.html'">Place Order</button>
                                </div>

                            </div>
                        </div>
                    </div>

                  </form>
                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
@endsection
