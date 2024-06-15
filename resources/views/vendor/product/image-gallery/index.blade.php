@extends('vendor.layouts.master')

@section('content')


    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fas fa-images"></i>Product Gallery</h3>
                        <div class="wsus__dashboard_profile">
                            @include('admin.layouts.flash-message')
                            <div class="wsus__dash_pro_area">
                                <div class="d-flex justify-content-end mb-2">
                                    <a href="{{route('vendor.products.index')}}" class="btn btn-primary"><i class="fas fa-arrow-left "></i> Back</a>
                                </div>
                                <div class="section-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Product: {{$product->name}}</h4>
                                                </div>
                                                <form class="card-body" action="{{route('vendor.products-variant.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group wsus__input">
                                                        <label>Image <code>(Multiple image supported!)</code></label>
                                                        <input type="file" name="image[]" class="form-control" multiple>
                                                        <input type="hidden" name="product" value="{{$product->id}}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-3">Upload</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row mt-5">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>All Images</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $dataTable->table() }}
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>






@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush




