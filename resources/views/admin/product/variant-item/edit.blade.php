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
                            <h4>Update variant items</h4>

                        </div>
                        <div class="card-body">
                            @include('admin.layouts.flash-message')
                            <form action="{{route('admin.products-variant-item.update', $item->id)}}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input name="variant_name" type="text" class="form-control" value="{{$item->productVariant->name}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="item_name" type="text" class="form-control" value="{{$item->name}}">
                                </div>

                                <div class="form-group">
                                    <label>Price <code>Set 0 to make it free</code></label>
                                    <input name="item_price" type="text" class="form-control" value="{{$item->price}}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Is default</label>
                                    <select name="is_default" id="inputState" class="form-control">
                                        <option {{$item->is_default == 1 ? 'selected' : ''}} value="1">Yes</option>
                                        <option {{$item->is_default == 0 ? 'selected' : ''}} value="0">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option {{$item->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$item->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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
