<!--==========================
  PRODUCT MODAL VIEW START
===========================-->


@foreach($flashSaleItems as $item)
    @php
        $product = \App\Models\Product::where('id', $item->product_id)
                                       ->where('status', 1)
                                       ->where('is_approved', 1)
                                       ->first();
    @endphp
    <section class="product_popup_modal">
        <div class="modal fade" id="exampleModal-{{$product->id}}" tabindex="-1" aria-hidden="true">
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
<!--==========================
  PRODUCT MODAL VIEW END
===========================-->
