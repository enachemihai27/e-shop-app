@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Shipping rules</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create shipping rule</h4>

                        </div>
                        <div class="card-body">
                            @include('admin.layouts.flash-message')
                            <form action="{{route('admin.shipping-rules.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control" value="{{old('name')}}">
                                </div>

                                <div class="form-group">
                                    <label >Type</label>
                                    <select name="type" class="form-control shipping-type">
                                        <option value="flat_cost">Flat Cost</option>
                                        <option value="min_cost">Minimum Order Amount</option>
                                    </select>
                                </div>

                                <div class="form-group min_cost d-none">
                                    <label>Minimum amount</label>
                                    <input name="min_cost" type="text" class="form-control" value="{{old('min_cost')}}">
                                </div>

                                <div class="form-group">
                                    <label>Cost</label>
                                    <input name="cost" type="number" class="form-control" value="{{old('cost')}}">
                                </div>


                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
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

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.shipping-type', function (){
                let value = $(this).val();
                if(value != 'min_cost'){
                    $('.min_cost').addClass('d-none');

                }else{
                    $('.min_cost').removeClass('d-none');
                }
            })
        })
    </script>
@endpush
