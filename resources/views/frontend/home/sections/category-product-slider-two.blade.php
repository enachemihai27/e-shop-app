@php

    $categoryProductSliderSectionTwo = json_decode($categoryProductSliderSectionTwo->value);

    $lastKey = [];

    foreach ($categoryProductSliderSectionTwo as $key => $category){
        if($category == null){
            break;
        }
        $lastKey = [$key => $category];

    }


    if (array_keys($lastKey)[0] == 'category') {
        $value = $lastKey['category'];
        $category = \App\Models\Category::findOrFail($value);
        $products = \App\Models\Product::where('category_id', $category->id)
                            ->take(12)
                            ->orderBy('id', 'DESC')
                            ->get();
    } elseif (array_keys($lastKey)[0] == 'sub_category') {
        $value = $lastKey['sub_category'];
        $category = \App\Models\SubCategory::findOrFail($value);
        $products = \App\Models\Product::where('sub_category_id', $category->id)
                            ->take(12)
                            ->orderBy('id', 'DESC')
                            ->get();
    }else{
        $value = $lastKey['child_category'];
        $category = \App\Models\ChildCategory::findOrFail($value);
        $products = \App\Models\Product::where('child_category_id', $category->id)
                            ->take(12)
                            ->orderBy('id', 'DESC')
                            ->get();


    }


@endphp


<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{$category->name}}</h3>
                    <a class="see_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach($products as  $product)

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
                                   data-bs-target="#product-slider-two-{{$product->id}}"><i class="far fa-eye"></i></a>
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
            @endforeach
        </div>
    </div>
</section>

@foreach($products as $product)


    <section class="product_popup_modal">
        <div class="modal fade" id="product-slider-two-{{$product->id}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="far fa-times"></i></button>
                        <div class="row">
                            <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                <div class="wsus__quick_view_img">
                                    @if(empty(!$product->video_link) && $product->video_link != null)
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                           href="{{$product->video_link}}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    @endif
                                    <div class="row modal_slider">

                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="{{asset($product->thumb_image)}}" alt="product"
                                                     class="img-fluid w-100">
                                            </div>
                                        </div>

                                        @if(count($product->imageGalleries) == 0)
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{asset($product->thumb_image)}}" alt="product"
                                                         class="img-fluid w-100">
                                                </div>
                                            </div>
                                        @endif

                                        @foreach($product->imageGalleries as $image)
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{asset($image->image)}}" alt="{{$product->name}}"
                                                         class="img-fluid w-100">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="wsus__pro_details_text">
                                    <a class="title" href="#">{{$product->name}}</a>
                                    <p class="wsus__stock_area"><span class="in_stock">in stock</span> (167 item)</p>
                                    @if(checkDiscount($product))
                                        <h4>{{$settings->currency_icon}} {{$product->offer_price}}
                                            <del>{{$settings->currency_icon}} {{$product->price}}</del>
                                        </h4>

                                    @else
                                        <h4>{{$settings->currency_icon}} {{$product->price}}</h4>
                                    @endif
                                    <p class="review">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>20 review</span>
                                    </p>
                                    <p class="description">{!! $product->short_description !!}</p>

                                    <form class="shopping-cart-form">
                                        <div class="wsus__selectbox">
                                            <div class="row">
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                @foreach($product->variants as $variant)
                                                    @if($variant->status == 1 && count($variant->productVariantItems)  >0)
                                                        <div class="col-xl-6 col-sm-6">
                                                            <h5 class="mb-2">{{$variant->name}}</h5>
                                                            <select class="select_2" name="variants_items[]">
                                                                @foreach($variant->productVariantItems as $item)
                                                                    @if($item->status == 1)
                                                                        <option
                                                                            value="{{$item->id}}" {{$item->is_default == 1 ? 'selected' : ''}}>{{$item->name}}  {{$item->price != 0 ? '(' . $settings->currency_icon . $item->price . ')' : ''}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="wsus__quentity">
                                            <h5>quentity :</h5>
                                            <div class="select_number">
                                                <input class="number_area" type="text" min="1" max="100" value="1"
                                                       name="qty"/>
                                            </div>
                                        </div>

                                        <ul class="wsus__button_area">
                                            <li>
                                                <button type="submit" class="add_cart" href="#">add to cart</button>
                                            </li>
                                            <li><a class="buy_now" href="#">buy now</a></li>
                                            <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                            <li><a href="#"><i class="far fa-random"></i></a></li>
                                        </ul>
                                    </form>


                                    <p class="brand_model"><span>brand :</span> {{$product->brand->name}}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endforeach
