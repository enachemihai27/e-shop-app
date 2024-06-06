@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Child Category</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create child category</h4>

                        </div>
                        <div class="card-body">
                            @include('admin.layouts.flash-message')
                            <form action="{{route('admin.child-category.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control main-category" name="category">
                                        <option value="">Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="sub-category">Sub Category</label>
                                    <select name="sub_category" id="sub-category" class="form-control sub-category" name="sub-category">
                                        <option value="">Select</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control" value="{{old('name')}}">
                                </div>


                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
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
        $(document).ready(function (){
            $('body').on('change', '.main-category', function (e){
                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.get-subcategories')}}",
                    data: {
                        id: id
                    },

                    success: function (data){
                        $('.sub-category').html('<option value="">Select</option>');


                        $.each(data, function (i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);


                        })

                    },
                    error: function (xhr, status, error){
                        console.log(error);
                    }


                })
            })

        })




    </script>

@endpush
