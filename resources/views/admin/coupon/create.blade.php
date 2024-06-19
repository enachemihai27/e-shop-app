@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Coupons</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create coupon</h4>

                        </div>
                        <div class="card-body">
                            @include('admin.layouts.flash-message')
                            <form action="{{route('admin.coupons.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control" value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label>Code</label>
                                    <input name="code" type="text" class="form-control" value="{{old('code')}}">
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input name="quantity" type="number" class="form-control" value="{{old('quantity')}}">
                                </div>
                                <div class="form-group">
                                    <label>Max Use Per Person</label>
                                    <input name="max_use" type="number" class="form-control" value="{{old('max_use')}}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start date</label>
                                            <input name="start_date" type="text" class="form-control datepicker" value="{{old('start_date')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End date</label>
                                            <input name="end_date" type="text" class="form-control datepicker" value="{{old('end_date')}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Discount type</label>
                                            <select name="discount_type" class="form-control">
                                                <option value="percent">Percentage (%)</option>
                                                <option value="amount">Amount ({{$settings->currency_icon}})</option>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Discount value</label>
                                            <input name="discount" type="number" class="form-control" value="{{old('discount_value')}}">
                                        </div>
                                    </div>
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
