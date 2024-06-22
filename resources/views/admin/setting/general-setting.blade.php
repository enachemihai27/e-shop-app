<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.general-setting-update')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Site Name</label>
                    <input name="site_name" type="text" class="form-control" value="{{$generalSetting->site_name}}">
                </div>

                <div class="form-group">
                    <label>Layout</label>
                    <select name="layout" class="form-control">
                        <option {{$generalSetting->layout == 'LTR' ? 'selected' : ''}} value="LTR">LTR</option>
                        <option {{$generalSetting->layout == 'RTR' ? 'selected' : ''}} value="RTR">RTR</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Contact Email</label>
                    <input name="contact_email" type="text" class="form-control" value="{{$generalSetting->contact_email}}">
                </div>

                <div class="form-group">
                    <label>Contact phone</label>
                    <input class="form-control" type="tel" name="contact_phone" maxlength="12" value="{{$generalSetting->contact_phone}}" required/>
                </div>

                <div class="form-group">
                    <label>Default Currency Name</label>
                    <select name="currency_name" class="form-control select2" value="">
                        <option value="">Select</option>
                        @foreach(config('setting.currency_list') as $currency)
                            <option {{$generalSetting->currency_name  == $currency ?  'selected' : ''}} value="{{$currency}}">{{$currency}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Icon</label>
                    <input name="currency_icon" type="text" class="form-control" value="{{$generalSetting->currency_icon}}">
                </div>

                <div class="form-group">
                    <label>Timezone</label>
                    <select name="time_zone" class="form-control select2">
                        <option value="">Select</option>
                        @foreach(config('setting.timezones') as $key => $timezone)
                            <option {{$generalSetting->timezone == $key ? 'selected' : ''}} value="{{$key}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>

            </form>
        </div>
    </div>
</div>
