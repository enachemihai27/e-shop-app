@extends('vendor.layouts.master')

@section('content')

    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Order details</h3>
                        <div class="wsus__dashboard_profile invoice-print">
                            <div class="wsus__invoice_area ">
                                <div class="wsus__invoice_header">
                                    <div class="wsus__invoice_content">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                <div class="wsus__invoice_single">

                                                    <h5>Shipped To</h5>
                                                    <h6>{{$address->name}}</h6>
                                                    <p>{{$address->email}}</p>
                                                    <p>{{$address->phone}}</p>
                                                    <p>{{$address->address}}, {{$address->city}}
                                                        , {{$address->state}}</p>
                                                    <p>{{$address->country}}</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                            </div>
                                            <div class="col-xl-4 col-md-4">
                                                <div class="wsus__invoice_single text-md-end">
                                                    <h5>Order id: #{{$order->invoice_id}}</h5>
                                                    <h6>Order
                                                        status: {{getOrderStatusVendor()[$order->order_status]['status']}}</h6>
                                                    <p>Payment Method: {{$order->payment_method}}</p>
                                                    <p>Payment Method: {{$order->payment_status}}</p>
                                                    <p>Transaction Id: {{$order->transaction->transaction_id}}</p>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wsus__invoice_description">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th class="name">
                                                        product
                                                    </th>

                                                    <th class="amount">
                                                        vendor
                                                    </th>

                                                    <th class="amount">
                                                        amount
                                                    </th>

                                                    <th class="quentity">
                                                        quentity
                                                    </th>
                                                    <th class="total">
                                                        total
                                                    </th>
                                                </tr>
                                                @foreach($order->orderProducts as $product)

                                                    @php
                                                        $variants = json_decode($product->variants);
                                                        $total = 0;
                                                        $variantsPrice = 0;
                                                        if($variants != null){
                                                            foreach ($variants as $variant){
                                                                $variantsPrice += $variant->price;
                                                            }
                                                        }

                                                        $total += $product->unit_price * $product->qty + $variantsPrice;
                                                    @endphp
                                                    <tr>

                                                        <td class="name">
                                                            <p>{{$product->product_name}}</p>
                                                            @foreach($variants as $key => $item)
                                                                <span>{{$key}} : {{$item->name}}( {{$item->price . ' ' . $settings->currency_icon}} )</span>
                                                            @endforeach
                                                        </td>

                                                        <td class="amount">
                                                            {{$product->vendor->name}}
                                                        </td>

                                                        <td class="amount">
                                                            {{$product->unit_price . ' ' . $settings->currency_icon}}
                                                        </td>

                                                        <td class="quentity">
                                                            {{$product->qty}}
                                                        </td>
                                                        <td class="total">
                                                            {{$total . ' ' .$settings->currency_icon}}
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="wsus__invoice_footer">
                                    @php
                                        $shipping = json_decode($order->shipping_method);
                                        $coupon = json_decode($order->coupon);
                                    @endphp
                                    <p><span>Sub Total :</span> {{$order->subtotal . ' ' .$settings->currency_icon}} </p>
                                    @if($shipping !=null && $shipping->cost != null)<p><span>Shipping Fee(+) :</span> {{$shipping->cost . ' ' .$settings->currency_icon}} </p>@endif
                                    @if($coupon !=null && $coupon->discount != null)<p><span>Coupon :(-</span> {{$coupon->discount . ' ' .$settings->currency_icon}} </p>@endif
                                    <p><span>Total Amount:</span> {{$order->amount . ' ' .$settings->currency_icon}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mt-5 float-end">
                            <button class="btn btn-warning print_invoice">Print</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $('.print_invoice').on('click', function () {
            let printBody = $('.invoice-print');
            let originalContents = $('body').html();
            $('body').html(printBody.html());
            window.print();
            $('body').html(originalContents);

        })
    </script>
@endpush
