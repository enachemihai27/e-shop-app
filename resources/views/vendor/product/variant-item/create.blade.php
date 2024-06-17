@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Crate characteristic</h3>
                        <div class="wsus__dashboard_profile">
                            @include('admin.layouts.flash-message')
                            <div class="wsus__dash_pro_area">
                                <form action="{{route('vendor.products-variant-item.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group wsus__input">
                                        <label>Variant Name</label>
                                        <input name="variant_name" type="text" class="form-control" value="{{$variant->name}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <input name="variant_id" type="hidden" class="form-control" value="{{$variant->id}}">
                                    </div>

                                    <div class="form-group">
                                        <input name="product_id" type="hidden" class="form-control" value="{{$product->id}}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Item Name</label>
                                        <input name="item_name" type="text" class="form-control" value="{{old('name')}}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Price <code>Set 0 to make it free</code></label>
                                        <input name="item_price" type="text" class="form-control" value="{{old('name')}}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="is_default">Is Default</label>
                                        <select name="is_default" id="is_default" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label for="inputState">Status</label>
                                        <select name="status" id="inputState" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4">Create</button>
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

