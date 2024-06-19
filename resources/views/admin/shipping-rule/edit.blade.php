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
                            <h4>Edit shipping rule</h4>

                        </div>
                        <div class="card-body">
                            @include('layouts.flash-message')
                            <form action="{{route('admin.shipping-rules.update', $rule->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control" value="{{$rule->name}}">
                                </div>

                                <div class="form-group">
                                    <label >Type</label>
                                    <select name="type" class="form-control shipping-type">
                                        <option {{$rule->type == 'flat_cost' ? 'selected' : ''}} value="flat_cost">Flat Cost</option>
                                        <option {{$rule->type == 'min_cost' ? 'selected' : ''}} value="min_cost">Minimum Order Amount</option>
                                    </select>
                                </div>

                                <div class="form-group min_cost {{$rule->type == 'min_cost' ? '' : 'd-none'}}">
                                    <label>Minimum amount</label>
                                    <input name="min_cost" type="text" class="form-control" value="{{$rule->min_cost}}">
                                </div>

                                <div class="form-group">
                                    <label>Cost</label>
                                    <input name="cost" type="number" class="form-control" value="{{$rule->cost}}">
                                </div>


                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option {{$rule->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$rule->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                    </select>
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
