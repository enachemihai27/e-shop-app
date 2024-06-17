@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Update item</h3>
                        <div class="wsus__dashboard_profile">
                            @include('admin.layouts.flash-message')
                            <div class="wsus__dash_pro_area">
                                <form action="{{route('vendor.products-variant-item.update', $item->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group wsus__input">
                                        <label>Variant Name</label>
                                        <input name="variant_name" type="text" class="form-control" value="{{$item->productVariant->name}}" readonly>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Name</label>
                                        <input name="item_name" type="text" class="form-control" value="{{$item->name}}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Price <code>Set 0 to make it free</code></label>
                                        <input name="item_price" type="text" class="form-control" value="{{$item->price}}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="inputState">Is default</label>
                                        <select name="is_default" id="inputState" class="form-control">
                                            <option {{$item->is_default == 1 ? 'selected' : ''}} value="1">Yes</option>
                                            <option {{$item->is_default == 0 ? 'selected' : ''}} value="0">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="inputState">Status</label>
                                        <select name="status" id="inputState" class="form-control">
                                            <option {{$item->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                            <option {{$item->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4">Update</button>
                                </form>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
