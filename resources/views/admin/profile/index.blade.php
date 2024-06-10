@extends('admin.layouts.master')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        @include('layouts.flash-message')
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">

                        <form method="post" class="needs-validation" enctype="multipart/form-data"
                              action="{{route('admin.profile.update')}}">
                            @csrf
                            <div class="card-header">
                                <h4>Update Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group">
                                        <img
                                            src="{{Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/images/ts-2.jpg')}}"
                                            alt="img" style="width: 200px; height: 200px;"
                                            class="img-fluid">

                                        <input id="image" name="image" type="file">
                                    </div>


                                    <div class="form-group col-md-6 col-12">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{Auth::user()->name}}">
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control"
                                               value="{{Auth::user()->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" class="needs-validation"
                              action="{{route('admin.password.update')}}">
                            @csrf
                            <div class="card-header">
                                <h4>Update Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group  col-12">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password" class="form-control" value="">
                                    </div>
                                    <div class="form-group  col-12">
                                        <label>New Password</label>
                                        <input type="password" name="password" class="form-control" value="">
                                    </div>
                                    <div class="form-group  col-12">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               value="">
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
