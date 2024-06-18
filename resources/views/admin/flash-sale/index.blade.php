@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Flash sale</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Flash end date</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.flash-sale.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sale end date</label>
                                        <input name="end_date" type="text" class="form-control datepicker" value="{{@$flashSaleEndDate->end_date}}">
                                    </div>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @include('admin.layouts.flash-message')
                        <div class="card-header">
                            <h4>Add product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.flash-sale.add-product')}}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Add products</label>
                                        <select name="product" class="form-control select2" value="" >
                                            <option value="" >Select</option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}" >{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="show_at_home">Show home</label>
                                        <select name="show_at_home" id="show_at_home" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All flash sale products</h4>
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
                    url: "{{ route('admin.flash-sale.change-status') }}",
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
            //change show at home status
            $('body').on('click', '.change-at-home-status', function (){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.flash-sale.show-at-home.change-status') }}",
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
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>

@endpush
