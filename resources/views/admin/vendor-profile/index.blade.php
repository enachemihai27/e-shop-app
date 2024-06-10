@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Vendor profile</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update vendor</h4>

                        </div>
                        <div class="card-body">
                            @include('admin.layouts.flash-message')
                            <form action="{{route('admin.vendor-profile.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <br>
                                    <img src="{{asset($profile->banner)}}" width="200px" alt="">
                                </div>

                                <div class="form-group">
                                    <label>Banner</label>
                                    <input name="banner" type="file" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control" value="{{$profile->name}}">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input name="phone" type="text" class="form-control" value="{{$profile->phone}}">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control" value="{{$profile->email}}">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input name="address" type="text" class="form-control" value="{{$profile->address}}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="summernote">{{$profile->description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input name="fb_link" type="text" class="form-control" value="{{$profile->fb_link}}">
                                </div>

                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input name="inst_link" type="text" class="form-control" value="{{$profile->inst_link}}">
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
