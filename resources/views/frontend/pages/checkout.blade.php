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
                        <h4>check out</h4>
                        <ul>
                            <li><a href="{{url('/')}}">home</a></li>
                            <li><a href="javascript:;">check out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <section id="wsus__cart_view">
        <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="wsus__check_form">
                            <h5>Billing Details <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">add
                                    new address</a></h5>

                            <div class="row">
                                @foreach($addresses as $address)
                                    <div class="col-xl-6">
                                    <div class="wsus__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input shipping_address" data-id="{{$address->id}}" type="radio" name="flexRadioDefault"
                                                   id="flexRadioDefault1" >
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Select Address
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>Name :</span> {{$address->name}}</li>
                                            <li><span>Phone :</span> {{$address->phone}}</li>
                                            <li><span>Email :</span> {{$address->email}}</li>
                                            <li><span>Country :</span> {{$address->country}}</li>
                                            <li><span>State :</span> {{$address->state}}</li>
                                            <li><span>City :</span> {{$address->city}}</li>
                                            <li><span>Address :</span> {{$address->address}}</li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="wsus__order_details" id="sticky_sidebar">
                            <p class="wsus__product">shipping Methods</p>

                            @foreach($shippingMethods as $method)
                                    @if($method->type == 'min_cost' && cartTotal() >= $method->min_cost)


                                        <div class="form-check">
                                            <input class="form-check-input shipping_method" type="radio" name="exampleRadios" id="exampleRadios1"
                                                   value="{{$method->id}}" data-id="{{$method->cost}}">
                                            <label class="form-check-label" for="exampleRadios1">
                                                {{$method->name}}
                                                <span>cost: {{$settings->currency_icon}}{{$method->cost}}</span>
                                            </label>
                                        </div>
                                    @elseif($method->type == 'flat_cost')
                                        <div class="form-check">
                                            <input class="form-check-input shipping_method" type="radio" name="exampleRadios" id="exampleRadios1"
                                                   value="{{$method->id}}" data-id="{{$method->cost}}">
                                            <label class="form-check-label" for="exampleRadios1">
                                                {{$method->name}}
                                                <span>cost: {{$settings->currency_icon}}{{$method->cost}}</span>
                                            </label>
                                        </div>
                                @endif
                            @endforeach
                            <div class="wsus__order_details_summery">
                                <p>subtotal: <span>{{$settings->currency_icon}}{{cartTotal()}}</span></p>
                                <p>shipping fee: <span id="shipping_fee">{{$settings->currency_icon}}0</span></p>
                                <p>Discount: <span>{{$settings->currency_icon}}{{getCartDiscount()}}</span></p>
                                <p><b>total:</b> <span><b id="total_amount" data-id="{{getMainCartTotal()}}">{{$settings->currency_icon}}{{getMainCartTotal()}}</b></span></p>
                            </div>
                            <div class="terms_area">
                                <div class="form-check">
                                    <input class="form-check-input agree_term" type="checkbox" value="" id="flexCheckChecked3">
                                    <label class="form-check-label" for="flexCheckChecked3">
                                        I have read and agree to the website <a href="#">terms and conditions *</a>
                                    </label>
                                </div>
                            </div>

                            <form action="" id="checkout_form">
                                <input type ="hidden" name="shipping_method_id" value="" id="shipping_method_id">
                                <input type ="hidden" name="shipping_address_id" value="" id="shipping_address_id">

                                <a type="submit" id="submitCheckoutForm" class="common_btn">Place Order</a>
                            </form>


                        </div>
                    </div>
                </div>

        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <form action="{{route('user.checkout.create-address')}}" method="POST">
                                @csrf
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Name *" name="name" required value="{{old('name')}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Phone *" name="phone" required value="{{old('name')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="email" placeholder="Email *" name="email" required value="{{old('email')}}">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Country *" name="country" required value="{{old('country')}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="State *" name="state" required value="{{old('state')}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="City *" name="city" required value="{{old('city')}}">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Address *" name="address" required value="{{old('address')}}">
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__check_single_form">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function (){

            $('input[type="radio"]').prop('checked', false);
            $('#shipping_method_id').val("");
            $('#shipping_address_id').val("");

            $('.shipping_method').on('click', function (){
                let shippingFee = $(this).data('id');
                let currentTotalAmount = $('#total_amount').data('id');
                let totalAmount = currentTotalAmount + shippingFee;

                $('#shipping_method_id').val($(this).val());
                $('#shipping_fee').text("{{$settings->currency_icon}}"+shippingFee);

                $('#total_amount').text("{{$settings->currency_icon}}"+totalAmount);
            });


            $('.shipping_address').on('click', function (){
                $('#shipping_address_id').val($(this).data('id'));
            });



            //submit checkout form
            $('#submitCheckoutForm').on('click', function (e){
               e.preventDefault();

               if($('#shipping_method_id').val() == ""){
                   toastr.error('Shipping Method is required!');
               }else if($('#shipping_address_id').val() == ""){
                    toastr.error('Shipping address is required!');

               }else if(!$('.agree_term').prop('checked')){
                   toastr.error('You have to agree website terms and conditions!');

               } else {

                   $.ajax({
                       method: 'POST',
                       headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                       url: "{{route('user.checkout.form-submit')}}",
                       data: $('#checkout_form').serialize(),
                       beforeSend: function (){
                           $('#submitCheckoutForm').html('<i class="fas fa-spinner fa-spin fa-1x"></i>');
                       },
                       success: function (data) {
                           if (data.status == 'success') {
                               $('#submitCheckoutForm').text('Place Order');

                               window.location.href = data.redirect_url;

                           }
                       },
                       error: function (data) {
                           console.log(data);
                       }
                   })
               }

            });




        });




    </script>

@endpush



