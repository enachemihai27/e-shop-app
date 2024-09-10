@php

    $slicerSectionOne = json_decode($slicerSectionOne->value);

@endphp


<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">

    <div class="card border">
        <div class="card-body">
            @include('admin.layouts.flash-message')

            <form action="{{route('admin.product-slider-section-one')}}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_1" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach($categories as $category)
                                    <option {{$category->id == $slicerSectionOne->category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">

                            @php
                                $subCategories = \App\Models\SubCategory::where('category_id', $slicerSectionOne->category)->get();
                            @endphp

                            <label>Sub Category</label>
                            <select name="sub_category_1" class="form-control sub-category">
                                <option value="">Select</option>
                                @foreach($subCategories as $subcategory)
                                    <option {{$subcategory->id == $slicerSectionOne->sub_category ? 'selected' : ''}} value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">

                            @php
                                $childcategories = \App\Models\ChildCategory::where('sub_category_id', $slicerSectionOne->sub_category )->get();
                            @endphp
                            <label>Child Category</label>
                            <select name="child_category_1" class="form-control" child-category>
                                <option value="">Select</option>
                                @foreach($childcategories as $childcategory)
                                    <option {{$childcategory->id == $slicerSectionOne->child_category ? 'selected' : ''}} value="{{$childcategory->id}}">{{$childcategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <button class="btn btn-primary" type="submit">Update</button>

            </form>
        </div>
    </div>
</div>


@push('scripts')

    <script>
        $(document).ready(function () {
            $('body').on('change', '.main-category', function (e) {
                let id = $(this).val();
                let row = $(this).closest('.row');

                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.get-subcategories')}}",
                    data: {
                        id: id
                    },

                    success: function (data) {
                        let selector = row.find('.sub-category');
                        selector.html('<option value="">Select</option>');


                        $.each(data, function (i, item) {
                            selector.append(`<option value="${item.id}">${item.name}</option>`);

                        })

                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }


                })
            });

            $('body').on('change', '.sub-category', function (e) {
                let id = $(this).val();
                let row = $(this).closest('.row');
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.products.get-child-categories')}}",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        let selector = row.find('.child-category');
                        selector.html('<option value="">Select</option>');

                        $.each(data, function (i, item) {
                            selector.append(`<option value="${item.id}">${item.name}</option>`);

                        })
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            });
        });


    </script>

@endpush
