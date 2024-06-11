@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update product</h4>

                        </div>
                        <div class="card-body">
                            @include('admin.layouts.flash-message')
                            <form action="{{route('admin.products.update', $product->id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                   <img src="{{asset($product->thumb_image)}}" style="width: 200px">
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input name="image" type="file" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control" value="{{$product->name}}">
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select name="category" id="category" class="form-control main-category">
                                                <option value="">Select</option>
                                                @foreach($categories as $category)
                                                    <option {{$product->category_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_category">Sub category</label>
                                            <select name="sub_category" id="sub_category"
                                                    class="form-control sub-category">
                                                <option value="">Select</option>
                                                @foreach($subCategories as $subCategory)
                                                    <option {{$subCategory->id == $product->sub_category_id ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="child_category">Child category</label>
                                            <select name="child_category" id="child_category"
                                                    class="form-control child-category">
                                                <option value="">Select</option>
                                                @foreach($childCategories as $childCategory)
                                                    <option {{$childCategory->id == $product->child_category_id ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($brands as $brand)
                                            <option {{$brand->id == $product->brand_id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>SKU</label>
                                    <input name="sku" type="text" class="form-control" value="{{$product->sku}}">
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input name="price" type="text" class="form-control" value="{{$product->price}}">
                                </div>

                                <div class="form-group">
                                    <label>Offer Price</label>
                                    <input name="offer_price" type="text" class="form-control"
                                           value="{{$product->offer_price}}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Offer start date</label>
                                            <input name="offer_start_date" type="text" class="form-control datepicker"
                                                   value="{{$product->offer_start_date}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Offer end date</label>
                                            <input name="offer_end_date" type="text" class="form-control datepicker"
                                                   value="{{$product->offer_end_date}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Stock quantity</label>
                                    <input name="qty" min="0" type="number" class="form-control" value="{{$product->qty}}">
                                </div>

                                <div class="form-group">
                                    <label>Video Link</label>
                                    <input name="video_link" type="text" class="form-control"
                                           value="{{$product->video_link}}">
                                </div>


                                <div class="form-group">
                                    <label>Short description</label>
                                    <textarea name="short_description" class="form-control">{{$product->short_description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Long description</label>
                                    <textarea name="long_description" class="form-control summernote">{{$product->long_description}}</textarea>
                                </div>


                                <div class="form-group">
                                    <label for="type">Product Type</label>
                                    <select name="product_type" id="type" class="form-control">
                                        <option value="">Select</option>
                                        <option {{$product->product_type == 'new_arrival' ? 'selected' : ''}} value="new_arrival">New Arrival</option>
                                        <option {{$product->product_type == 'featured' ? 'selected' : ''}} value="featured">Featured</option>
                                        <option {{$product->product_type == 'top_product' ? 'selected' : ''}} value="top_product">Top Product</option>
                                        <option {{$product->product_type == 'best_product' ? 'selected' : ''}} value="best_product">Best Product</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Seo title</label>
                                    <input name="seo_title" type="text" class="form-control"
                                           value="{{$product->seo_title}}">
                                </div>


                                <div class="form-group">
                                    <label>Seo description</label>
                                    <textarea name="seo_description" class="form-control">{!!$product->seo_description!!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option {{$product->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$product->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script>

        $(document).ready(function () {
            $('body').on('change', '.main-category', function (e) {
                $('.child-category').html('<option value="">Select</option>');
                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.products.get-sub-categories')}}",
                    data: {
                        id: id
                    },

                    success: function (data) {
                        $('.sub-category').html('<option value="">Select</option>');


                        $.each(data, function (i, item) {
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);


                        })

                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            })

        })

        $(document).ready(function () {
            $('body').on('change', '.sub-category', function (e) {
                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.products.get-child-categories')}}",
                    data: {
                        id: id
                    },

                    success: function (data) {
                        $('.child-category').html('<option value="">Select</option>');


                        $.each(data, function (i, item) {
                            $('.child-category').append(`<option value="${item.id}">${item.name}</option>`);


                        })

                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            })

        })
    </script>
@endpush
