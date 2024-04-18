@extends('back.layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Basic form elements</h4>
                        @if(session('success'))
                            <div class="alert alert-success mt-3" id="success-div">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger mt-3" id="error-div">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="width: 70%;">
        <div class="card">
            <div class="card-header">
                Invoice №:
                <strong style="margin-right: 300px">{{$invoice->order_no ?? ''}}</strong>
                Date:
                <strong>{{isset($invoice->created_at) ? Carbon\Carbon::parse($invoice->created_at)->format('d.m.y H:i') : ''}}</strong>
                <span class="float-right"> <strong>Status:</strong> Pending</span>

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">Company:</h6>
                        <div>
                            <strong>Webz Poland</strong>
                        </div>
                        <div>Phone: +48 444 666 3333</div>
                        <div>Email: info@webz.com.pl</div>
                        <div>71-101 Szczecin, Poland</div>
                    </div>

                    <div class="col-sm-6">
                        <h6 class="mb-3">Customer Information:</h6>
                        <div>
                            <strong>Name and Surname: {{$invoice->name ?? ''}}</strong>
                        </div>
                        <div>Phone: {{$invoice->phone ?? ''}}</div>
                        <div>Email: {{$invoice->email ?? ''}}</div>
                        <div>Address: {{$invoice->address ?? ''}}</div>
                        <div>Zip Code: {{$invoice->postal_zip ?? ''}}</div>
                        <div>Notes: {{$invoice->notes ?? ''}}</div>
                        <div>{{$invoice->city ?? ''}}, {{$invoice->country ?? ''}}</div>
                    </div>

                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Product Name</th>
                            <th class="right">Unit Price</th>
                            <th class="center">Qty</th>
                            <th class="right">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $subTotal = 0;
                             $coupon = session()->get('coupon_code');

                        @endphp
                        @if(!empty($invoice->orders))
                            @foreach($invoice->orders as $order)
                                @php
                                    $price=$order['price'];
                                    $qty=$order['quantity'];
                                    $total=$price*$qty;
                                    $subTotal += $total;

                                @endphp
                                <tr>
                                    <td class="center">{{$order['id']}}</td>
                                    <td class="left strong">{{$order['name']}}</td>
                                    <td class="right">${{$order['price']}}</td>
                                    <td class="center">{{$order['quantity']}}</td>
                                    <td class="right">${{$total}}</td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                            <tr>
                                <td class="left">
                                    <strong>Subtotal</strong>
                                </td>
                                <td class="right">${{$subTotal}}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Coupon Sale</strong>
                                </td>
                                <td class="right">${{$couponPrice}}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Total</strong>
                                </td>
                                <td class="right">
                                    <strong>${{session()->get('total_price') ?? 0}}</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
