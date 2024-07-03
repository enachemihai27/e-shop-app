<div class="tab-pane fade show" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">

    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.stripe-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Stripe status</label>
                    <select name="status" class="form-control">
                        <option {{$stripeSetting->status == 1 ? 'selected' : ''}} value="1">Enable</option>
                        <option {{$stripeSetting->status == 0 ? 'selected' : ''}}  value="0">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Account mode</label>
                    <select name="mode" class="form-control">
                        <option {{$stripeSetting->mode == 0 ? 'selected' : ''}}  value="0">Sandbox</option>
                        <option {{$stripeSetting->mode == 1 ? 'selected' : ''}}  value="1">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <input name="country" type="hidden" class="form-control" value="Romania">
                </div>

                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency_name" class="form-control select2" style="width: 100% !important;">
                        <option  value="">Select</option>
                        @foreach(config('setting.currency_list') as $key => $value)
                            <option {{$stripeSetting->currency_name == $value ? 'selected' : ''}}  value="{{$value}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency rate ( Per {{$settings->currency_name}} )</label>
                    <input name="currency_rate" type="text" class="form-control" value="{{$stripeSetting->currency_rate}}">
                </div>

                <div class="form-group">
                    <label>Client id</label>
                    <input name="client_id" type="text" class="form-control" value="{{$stripeSetting->client_id}}">
                </div>

                <div class="form-group">
                    <label>Secret key</label>
                    <input name="secret_key" type="text" class="form-control" value="{{$stripeSetting->secret_key}}">
                </div>


                <button class="btn btn-primary" type="submit">Update</button>

            </form>
        </div>
    </div>
</div>
