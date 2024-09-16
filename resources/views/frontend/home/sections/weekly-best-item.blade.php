@php

    $categoryProductSliderSectionThree = json_decode($categoryProductSliderSectionThree->value, true)


@endphp


<section id="wsus__weekly_best" class="home2_wsus__weekly_best_2 ">
    <div class="container">
        <div class="row">

            @foreach($categoryProductSliderSectionThree as $sliderSectionThree)
                @php

                    $lastKey = [];
                    foreach ($sliderSectionThree as $key => $category) {
                        if ($category == null) {
                            break;
                        }
                        $lastKey = [$key => $category];
                    }

                    if (!empty($lastKey)) {
                        $key = array_keys($lastKey)[0];
                        $value = array_values($lastKey)[0];

                        if ($key === 'category') {
                                $category = \App\Models\Category::findOrFail($value);
                                $products = \App\Models\Product::where('category_id', $category->id)
                                    ->take(6)
                                    ->orderBy('id', 'DESC')
                                    ->get();
                            } elseif ($key === 'sub_category') {
                                $category = \App\Models\SubCategory::findOrFail($value);
                                $products = \App\Models\Product::where('sub_category_id', $category->id)
                                    ->take(6)
                                    ->orderBy('id', 'DESC')
                                    ->get();
                            } else {
                                $category = \App\Models\ChildCategory::findOrFail($value);
                                $products = \App\Models\Product::where('child_category_id', $category->id)
                                    ->take(6)
                                    ->orderBy('id', 'DESC')
                                    ->get();
                            }

                    }

                @endphp

                <div class="col-xl-6 col-sm-6">
                    <div class="wsus__section_header">
                        <h3>{{$category->name}}</h3>
                    </div>
                    <div class="row weekly_best2">


                        @foreach($products as $product)
                            <div class="col-xl-4 col-lg-4">
                            <a class="wsus__hot_deals__single" href="{{route('product-detail', $product->slug)}}">
                                <div class="wsus__hot_deals__single_img">
                                    <img src="{{ asset($product->thumb_image) }}" alt="{{$product->name}}" class="img-fluid w-100">
                                </div>
                                <div class="wsus__hot_deals__single_text mt-2">
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

                    </div>
                </div>

            @endforeach

        </div>
    </div>
</section>
