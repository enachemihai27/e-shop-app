<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.paypal-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Paypal status</label>
                    <select name="status" class="form-control">
                        <option {{$paypalSetting->status == 1 ? 'selected' : ''}} value="1">Enable</option>
                        <option {{$paypalSetting->status == 0 ? 'selected' : ''}}  value="0">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Account mode</label>
                    <select name="mode" class="form-control">
                        <option {{$paypalSetting->mode == 0 ? 'selected' : ''}}  value="0">Sandbox</option>
                        <option {{$paypalSetting->mode == 1 ? 'selected' : ''}}  value="1">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <input name="country" type="hidden" class="form-control" value="Romania">
                </div>

                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency_name" class="form-control select2">
                        <option  value="">Select</option>
                       @foreach(config('setting.currency_list') as $key => $value)
                            <option {{$paypalSetting->currency_name == $value ? 'selected' : ''}}  value="{{$value}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency rate ( Per USD )</label>
                    <input name="currency_rate" type="text" class="form-control" value="{{$paypalSetting->currency_rate}}">
                </div>

                <div class="form-group">
                    <label>Paypal client id</label>
                    <input name="client_id" type="text" class="form-control" value="{{$paypalSetting->client_id}}">
                </div>

                <div class="form-group">
                    <label>Paypal secret key</label>
                    <input name="secret_key" type="text" class="form-control" value="{{$paypalSetting->secret_key}}">
                </div>


                <button class="btn btn-primary" type="submit">Update</button>

            </form>
        </div>
    </div>
</div>
