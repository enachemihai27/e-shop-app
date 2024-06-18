@extends('frontend.layouts.master')

@section('content')

    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Flash Sale</h4>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="#">Flash Sale</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{asset('frontend/images/offer_banner_2.png')}}" alt="offrt img"
                                 class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>apple watch</p>
                                <span>up 50% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{asset('frontend/images/offer_banner_3.png')}}" alt="offrt img"
                                 class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>xiaomi power bank</p>
                                <span>up 37% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach($flashSaleItems as $item)
                        @php
                            $product = \App\Models\Product::find($item->product_id)
                        @endphp
                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            <div class="wsus__product_item">
                                <span class="wsus__new">{{productType($product->product_type)}}</span>
                                @if(checkDiscount($product))
                                    <span class="wsus__minus">-{{calculateDiscountPercent($product->price, $product->offer_price)}}%</span>
                                @endif
                                <a class="wsus__pro_link" href="product_details.html">
                                    <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100 img_1"/>
                                    <img src="
                                @if(isset($product->imageGalleries[0]->image))
                                    {{ asset($product->imageGalleries[0]->image) }}
                                 @else
                                    {{ asset($product->thumb_image) }}
                                 @endif"
                                         alt="product"
                                         class="img-fluid w-100 img_2"
                                    />
                                </a>
                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a>
                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category" href="#">{{$product->category->name}} </a>
                                    <p class="wsus__pro_rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>(133 review)</span>
                                    </p>
                                    <a class="wsus__pro_name" href="#">{{$product->name}}</a>
                                    @if(checkDiscount($product))
                                        <p class="wsus__price">$ {{$product->offer_price}}
                                            <del>$ {{$product->price}}</del>
                                        </p>

                                    @else
                                        <p class="wsus__price">$ {{$product->price}}</p>
                                    @endif
                                    <a class="add_cart" href="#">add to cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    @if($flashSaleItems->hasPages())
                        {{$flashSaleItems->links()}}
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            const yearValue = {{date('Y', strtotime($flashSaleDate->end_date))}};
            const monthValue = {{date('m', strtotime($flashSaleDate->end_date))}};
            const dayValue = {{date('d', strtotime($flashSaleDate->end_date))}};

            simplyCountdown('.simply-countdown-one', {
                year: parseInt(yearValue),
                month: parseInt(monthValue),
                day: parseInt(dayValue),
                enableUtc: true
            });
        });

    </script>
@endpush
