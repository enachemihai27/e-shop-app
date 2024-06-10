@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Brand</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All brands</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.brand.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}

    <script>
        $(document).ready(function (){
            $('body').on('click', '.change-status', function (){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.brand.change-status') }}",
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
