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
                        <h3><i class="far fa-user"></i>Products</h3>
                        <div class="creat_btn">
                            <a href="{{route('vendor.products.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create product</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            @include('admin.layouts.flash-message')
                            <div class="wsus__dash_pro_area">
                                {{ $dataTable->table() }}
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

@push('scripts')
    {{ $dataTable->scripts() }}

    <script>
        $(document).ready(function (){
            $('body').on('click', '.change-status', function (){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.products.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data){
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error){
                        toastr.error('An error occurred: ' + xhr.responseText);
                        console.log('Error:', error);
                        console.log('Status:', status);
                        console.log('Response:', xhr.responseText);
                    }
                });
            });
        });
    </script>

@endpush
