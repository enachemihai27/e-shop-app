@extends('frontend.layouts.master')

@section('content')

    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>payment</h4>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li><a href="javascript:;">payment</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="wsus__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">

                                <button class="nav-link common_btn active" id="v-pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-paypal" type="button" role="tab" aria-controls="v-pills-paypal"
                                        aria-selected="true">Paypal</button>


                                <button class="nav-link common_btn" id="v-pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-card-payment" type="button" role="tab" aria-controls="v-pills-card-payment"
                                        aria-selected="true">Stripe</button>


                                <button class="nav-link common_btn" id="v-pills-settings-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-cash" type="button" role="tab"
                                        aria-controls="v-pills-cash" aria-selected="false">cash on delivery</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">


                            <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                                 aria-labelledby="v-pills-settings-tab">
                                <a href="{{route('user.paypal.payment')}}" class="nav-link common_btn text-center" type="button">Pay with paypal</a>
                            </div>

                            @include('frontend.pages.payment-gateway.stripe')


                            <div class="tab-pane fade" id="v-pills-cash" role="tabpanel"
                                 aria-labelledby="v-pills-settings-tab">

                                <form class="wsus__input_area">
                                    <input type="text" placeholder="Enter Something">
                                    <textarea cols="3" rows="4" placeholder="Enter Something"></textarea>
                                    <select class="select_2" name="state">
                                        <option>default select</option>
                                        <option>short by rating</option>
                                        <option>short by latest</option>
                                        <option>low to high </option>
                                        <option>high to low</option>
                                    </select>
                                    <button type="submit" class="common_btn mt-4">confirm</button>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4">
                        <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                            <h5>Order Summary</h5>
                            <p>subtotal: <span>{{$settings->currency_icon}}{{cartTotal()}} </span></p>
                            <p>shipping fee(+): <span>{{$settings->currency_icon}}{{getShippingFee()}} </span></p>
                            <p>Discount(-): <span>{{$settings->currency_icon}}{{getCartDiscount()}} </span></p>
                            <h6>total <span>{{$settings->currency_icon}}{{getFinalPayableAmount()}} </span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        PAYMENT PAGE END
    ==============================-->

@endsection





