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
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="{{url('/')}}">home</a></li>
                            <li><a href="javascript:;">Product</a></li>
                            <li><a href="javascript:;">cart view</a></li>
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
        CART VIEW PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                <tr class="d-flex">
                                    <th class="wsus__pro_img">
                                        product item
                                    </th>

                                    <th class="wsus__pro_name" style="width: 285px;">
                                        product details
                                    </th>

                                    <th class="wsus__pro_tk">
                                        unit price
                                    </th>

                                    <th class="wsus__pro_tk">
                                        total price
                                    </th>

                                    <th class="wsus__pro_select">
                                        quantity
                                    </th>


                                    <th class="wsus__pro_icon">

                                        {{--          <form action="{{route('cart-clear')}}" method="POST">
                                                      @csrf--}}
                                        <button type="submit" class="common_btn clear_cart">clear cart</button>
                                        {{--        </form>--}}
                                    </th>
                                </tr>
                                @foreach($cartItems as $item)
                                    <tr class="d-flex">
                                        <td class="wsus__pro_img"><img src="{{asset($item->options->image)}}"
                                                                       alt="product"
                                                                       class="img-fluid w-100">
                                        </td>

                                        <td class="wsus__pro_name">
                                            <p>{!! $item->name !!}</p>
                                            @foreach($item->options->variants as $key => $variant)

                                                <span>{{$key}}: {{$variant['name']}} {{ $variant['price'] != 0 ? '(' . $settings->currency_icon . $variant['price'] . ')' : ''}}</span>

                                            @endforeach
                                        </td>


                                        <td class="wsus__pro_tk">
                                            <h6>{{$settings->currency_icon . $item->price}}</h6>
                                        </td>

                                        <td class="wsus__pro_tk">
                                            <h6 id="{{$item->rowId}}">{{$settings->currency_icon . (($item->price + $item->options->variants_total) * $item->qty)}}</h6>
                                        </td>


                                        <td class="wsus__pro_select">
                                            <div class="" style="display: flex;">
                                                <button class="btn btn-danger product-decrement"
                                                        style="margin-right: 3px;">-
                                                </button>
                                                <input class="product-qty" type="text" min="1" max="100"
                                                       value="{{$item->qty}}"
                                                       data-rowid="{{$item->rowId}}" readonly
                                                       style="width: 43px; height: 36px; padding-left: 5px"/>
                                                <button class="btn btn-success product-increment"
                                                        style="margin-left: 3px;">+
                                                </button>
                                            </div>
                                        </td>


                                        <td class="wsus__pro_icon">
                                            <a href="{{route('cart.remove-product', $item->rowId)}}"><i
                                                    class="far fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach


                                @if(count($cartItems) == 0)
                                    <tr class="d-flex">
                                        <td class="wsus__pro_icon" style="width:100%;">
                                            Cart is empty!

                                        </td>
                                    </tr>

                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span id="sub_total">{{$settings->currency_icon}}{{cartTotal()}}</span></p>

                        <p>discount: <span id="discount">{{$settings->currency_icon}}{{getCartDiscount()}}</span></p>

                        <p class="total"><span>total:</span> <span id="cart_total">{{$settings->currency_icon}}{{getMainCartTotal()}}</span></p>

                        <form id="coupon_form">
                            <input name="coupon_code" type="text" placeholder="Coupon Code" value="{{session()->has('coupon') ?
                                          session()->get('coupon')['coupon_code']  : ''}}">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="{{route('home')}}"><i
                                class="fab fa-shopify"></i> Keep Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_2.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_3.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
          CART VIEW PAGE END
    ==============================-->

@endsection

@push('scripts')
    <script>
        /*increment qty*/
        $(document).ready(function () {
            $('.product-increment').on('click', function () {
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');
                input.val(quantity);

                $.ajax({
                    url: '{{route('cart.update-quantity')}}',
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    data: {
                        quantity: quantity,
                        rowId: rowId

                    },
                    success: function (data) {
                        if (data.status == 'success') {
                            let productId = '#' + rowId;
                            let totalAmount = "{{$settings->currency_icon}}" + data.product_total;
                            $(productId).text(totalAmount);

                            renderCartSubtotal();
                            calculateCouponDiscount();

                            toastr.success(data.message);
                        } else if (data.status == 'error') {
                            toastr.error(data.message);
                        }
                    },
                    error: function (data) {
                    }
                })
            })


            /*decrement qty*/
            $('.product-decrement').on('click', function () {
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rowid');

                if (quantity < 1) {
                    quantity = 1;
                }

                input.val(quantity);

                $.ajax({
                    url: '{{route('cart.update-quantity')}}',
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    data: {
                        quantity: quantity,
                        rowId: rowId

                    },
                    success: function (data) {
                        if (data.status == 'success') {
                            let productId = '#' + rowId;
                            let totalAmount = "{{$settings->currency_icon}}" + data.product_total;
                            $(productId).text(totalAmount);

                            renderCartSubtotal();
                            calculateCouponDiscount();

                            toastr.success(data.message);
                        } else if (data.status == 'error') {
                            toastr.error(data.message);
                        }
                    },
                    error: function (data) {
                    }
                })
            })

            /*clear cart*/
            $('.clear_cart').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action will clear your cart!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, clear it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                                type: 'POST',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                                url: '{{route('clear.cart')}}',

                                success: function (data) {
                                    if (data.status == 'success') {
                                        window.location.reload();
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.log(error);
                                }
                            }
                        )

                    }
                });
            })


            //right subtotal in cart details page
            function renderCartSubtotal() {
                $.ajax({
                    method: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "{{route('cart.sidebar-product-total')}}",
                    success: function (data) {
                        $('#sub_total').text("{{$settings->currency_icon}}" + data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                })

            }


            //apply coupon on cart
            $('#coupon_form').on('submit', function (e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    method: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "{{route('apply-coupon')}}",
                    data: formData,
                    success: function (data) {
                        if (data.status == 'error') {
                            toastr.error(data.message);
                        } else if (data.status == 'success') {
                            calculateCouponDiscount();
                            toastr.success(data.message);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                })
            })

            //calculate discount
            function calculateCouponDiscount() {
                $.ajax({
                    method: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "{{route('coupon-calculation')}}",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('#discount').text('{{$settings->currency_icon}}' + data.discount);
                            $('#cart_total').text('{{$settings->currency_icon}}' + data.cart_total);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                })
            }


        });
    </script>

@endpush

