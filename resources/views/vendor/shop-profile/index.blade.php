@extends('vendor.layouts.master')

@section('content')

    <!--=============================
    DASHBOARD START
  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Shop profile</h3>
                        <div class="wsus__dashboard_profile">
                            @include('admin.layouts.flash-message')
                            <div class="wsus__dash_pro_area">
                                <form action="{{route('vendor.shop-profile.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group wsus__input">
                                        <label>Preview</label>
                                        <br>
                                        <img src="{{asset($profile->banner)}}" width="200px" alt="">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Banner</label>
                                        <input name="banner" type="file" class="form-control">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Shop name</label>
                                        <input name="name" type="text" class="form-control" value="{{$profile->name}}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Phone</label>
                                        <input name="phone" type="text" class="form-control" value="{{$profile->phone}}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Email</label>
                                        <input name="email" type="email" class="form-control" value="{{$profile->email}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Address</label>
                                        <input name="address" type="text" class="form-control" value="{{$profile->address}}">
                                    </div>
                                    <div class="form-group wsus__input">
                                        <label>Description</label>
                                        <textarea name="description" class="summernote">{{$profile->description}}</textarea>
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Facebook</label>
                                        <input name="fb_link" type="text" class="form-control" value="{{$profile->fb_link}}">
                                    </div>

                                    <div class="form-group wsus__input">
                                        <label>Instagram</label>
                                        <input name="inst_link" type="text" class="form-control" value="{{$profile->inst_link}}">
                                    </div>


                                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                                </form>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--=============================
      DASHBOARD END
    ==============================-->

@endsection
