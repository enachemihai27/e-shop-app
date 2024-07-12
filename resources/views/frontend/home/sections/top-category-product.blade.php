<section id="wsus__monthly_top" class="wsus__monthly_top_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="wsus__monthly_top_banner">
                    <div class="wsus__monthly_top_banner_img">
                        <img src="images/monthly_top_img3.jpg" alt="img" class="img-fluid w-100">
                        <span></span>
                    </div>
                    <div class="wsus__monthly_top_banner_text">
                        <h4>Black Friday Sale</h4>
                        <h3>Up To <span>70% Off</span></h3>
                        <h6>Everything</h6>
                        <a class="shop_btn" href="#">shop now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header for_md">
                    <h3>Popular Categories</h3>
                    <div class="monthly_top_filter">
                       {{-- <button class=" active" data-filter="*">All</button>--}}
                        @foreach($categoriesAndProducts as $category)
                            <button class="{{ $loop->index  == 0 ? 'auto_click active' : ''}}" data-filter=".category_{{$loop->index}}">{{$category['category']->name}}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row grid">
                    @foreach($categoriesAndProducts as  $key => $item)
                        @foreach($item['products'] as  $product)
                            <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3 category_{{$key}}">
                                <a class="wsus__hot_deals__single" href="#">
                                    <div class="wsus__hot_deals__single_img">
                                        <img src="{{ asset($product->thumb_image) }}" alt="{{$product->name}}" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__hot_deals__single_text">
                                        <h5>{!! limitText($product->name, ) !!}</h5>
                                        <p class="wsus__rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </p>
                                        @if(checkDiscount($product))
                                            <p class="wsus__tk">{{$product->offer_price}} {{$settings->currency_icon}}
                                                <del> {{$product->price}} {{$settings->currency_icon}}</del>
                                            </p>


                                        @else
                                            <p class="wsus__tk">{{$product->price}} {{$settings->currency_icon}}</p>
                                        @endif

                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
