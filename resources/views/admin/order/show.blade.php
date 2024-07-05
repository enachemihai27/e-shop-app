@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <div class="invoice-number">Order #{{$order->invoice_id}}</div>
                            </div>
                            <hr>
                            @php
                                $address = json_decode($order->order_address);
                            @endphp
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Shipped To:</strong><br>
                                        <b>Name:</b> {{$address->name}}<br>
                                        <b>Email:</b> {{$address->email}}<br>
                                        <b>Phone:</b> {{$address->phone}}<br>
                                        <b>Address: </b>{{$address->address}}<br>
                                        {{$address->city}}, {{$address->state}}, {{$address->country}}
                                    </address>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Payment Information:</strong><br>
                                        <b>Method:</b> {{$order->payment_method}}<br>
                                        <b>Transaction Id:</b> {{$order->transaction->transaction_id}}<br>
                                        <b>Status:</b> {{$order->payment_status == 1 ? 'Complete' : 'Pending' }}<br>
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        {{date('d F, Y', strtotime($order->created_at))}}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Item</th>
                                        <th>Variant</th>
                                        <th>Shop name</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Totals</th>
                                    </tr>
                                    @foreach($order->orderProducts as $product)
                                        @php
                                            $variants = json_decode($product->variants)
                                        @endphp
                                        <tr>
                                            <td>{{++$loop->index}}</td>

                                            @if(isset($product->product->slug))
                                                <td><a target="_blank"
                                                       href="{{route('product-detail', $product->product->slug)}}">{{$product->product_name}}</a>
                                                </td>
                                            @else
                                                <td>{{$product->product_name}}</td>
                                            @endif
                                            <td>
                                                @if($variants != null)
                                                    @foreach($variants as $key => $variant)
                                                        <b>{{$key}}: </b> {{$variant->name}}
                                                        ( {{$variant->price}} {{$settings->currency_icon}} )
                                                    @endforeach
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                            <td>{{$product->vendor->name}}</td>
                                            <td class="text-center">{{$product->unit_price}} {{$settings->currency_icon}}</td>
                                            <td class="text-center">{{$product->qty}}</td>
                                            <td class="text-right">{{($product->unit_price * $product->qty) + $product->variant_total}} {{$settings->currency_icon}}</td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">

                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Subtotal</div>
                                        <div
                                            class="invoice-detail-value">{{$order->subtotal}} {{$settings->currency_icon}}</div>
                                    </div>

                                    @php
                                        $shipping = json_decode($order->shipping_method);
                                        $coupon = json_decode($order->coupon);
                                    @endphp

                                    @if($shipping != null)
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Shipping (+)</div>
                                            <div
                                                class="invoice-detail-value">{{@$shipping->cost}} {{$settings->currency_icon}}</div>
                                        </div>
                                    @endif

                                    @if($coupon != null)
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Coupon (-)</div>
                                            <div
                                                class="invoice-detail-value">{{@$coupon->discount}} {{$settings->currency_icon}}</div>
                                        </div>
                                    @endif

                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div
                                            class="invoice-detail-value invoice-detail-value-lg">{{$order->subtotal + @$shipping->cost + @$coupon->discount }} {{$settings->currency_icon}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3">
                        <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process
                            Payment
                        </button>
                        <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
                    </div>
                    <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>


    </section>

@endsection
