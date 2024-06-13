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
                        <h3><i class="far fa-user"></i> profile</h3>
                        <div class="wsus__dashboard_profile">
                            @include('admin.layouts.flash-message')
                            <h4>Basic information</h4>





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
