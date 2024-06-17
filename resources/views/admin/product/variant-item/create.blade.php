@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Product Variant Items</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create variant item</h4>
                        </div>
                        <div class="card-body">
                            @include('admin.layouts.flash-message')
                            <form action="{{route('admin.products-variant-item.store')}}" method="POST">
                                @csrf


                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input name="variant_name" type="text" class="form-control" value="{{$variant->name}}" readonly>
                                </div>

                                <div class="form-group">
                                    <input name="variant_id" type="hidden" class="form-control" value="{{$variant->id}}">
                                </div>

                                <div class="form-group">
                                    <input name="product_id" type="hidden" class="form-control" value="{{$product->id}}">
                                </div>

                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input name="item_name" type="text" class="form-control" value="{{old('name')}}">
                                </div>

                                <div class="form-group">
                                    <label>Price <code>Set 0 to make it free</code></label>
                                    <input name="item_price" type="text" class="form-control" value="{{old('name')}}">
                                </div>

                                <div class="form-group">
                                    <label for="is_default">Is Default</label>
                                    <select name="is_default" id="is_default" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
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
