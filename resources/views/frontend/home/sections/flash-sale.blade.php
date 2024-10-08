<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{asset('frontend/images/flash_sell_bg.jpg')}})">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">Flash sell</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{route('flash-sale')}}">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach($flashSaleItems as $item)
                @php
                    $product = \App\Models\Product::where('id', $item->product_id)
                                                   ->where('status', 1)
                                                   ->where('is_approved', 1)
                                                   ->first();
                @endphp

                @if($product)
                    <div class="col-xl-3 col-sm-6 col-lg-4">
                        <div class="wsus__product_item">
                            <span class="wsus__new">{{ productType($product->product_type) }}</span>
                            @if(checkDiscount($product))
                                <span class="wsus__minus">-{{ calculateDiscountPercent($product->price, $product->offer_price) }}%</span>
                            @endif
                            <a class="wsus__pro_link" href="{{ route('product-detail', $product->slug) }}">
                                <img src="{{ asset($product->thumb_image) }}" alt="product"
                                     class="img-fluid w-100 img_1"/>
                                <img
                                    src="{{ isset($product->imageGalleries[0]->image) ? asset($product->imageGalleries[0]->image) : asset($product->thumb_image) }}"
                                    alt="product" class="img-fluid w-100 img_2"/>
                            </a>
                            <ul class="wsus__single_pro_icon">
                                <li><a href="#" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal-{{$product->id}}"><i class="far fa-eye"></i></a>
                                </li>
                                <li><a href="#"><i class="far fa-heart"></i></a></li>
                                <li><a href="#"><i class="far fa-random"></i></a></li>
                            </ul>
                            <div class="wsus__product_details">
                                <a class="wsus__category" href="">{{ $product->category->name }}</a>
                                <p class="wsus__pro_rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>(133 review)</span>
                                </p>
                                <a class="wsus__pro_name"
                                   href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>
                                @if(checkDiscount($product))
                                    <p class="wsus__price">{{ $settings->currency_icon }} {{ $product->offer_price }}
                                        <del>{{ $settings->currency_icon }} {{ $product->price }}</del>
                                    </p>
                                @else
                                    <p class="wsus__price">{{ $settings->currency_icon }} {{ $product->price }}</p>
                                @endif
                                <form class="shopping-cart-form">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    @foreach($product->variants as $variant)
                                        @if($variant->status == 1 && count($variant->productVariantItems)  >0)
                                            <select class="d-none" name="variants_items[]">
                                                @foreach($variant->productVariantItems as $item)
                                                    @if($item->status == 1)
                                                        <option value="{{$item->id}}" {{$item->is_default == 1 ? 'selected' : ''}}>{{$item->name}}  {{$item->price != 0 ? '(' . $settings->currency_icon . $item->price . ')' : ''}}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        @endif
                                    @endforeach
                                    <input type="hidden" min="1" max="100" value="1" name="qty"/>

                                    <button type="submit" class="add_cart" href="#">add to cart</button>


                                </form>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
</section>

@include('frontend.home.sections.product-modal')

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
            });
        });

    </script>

@endpush
