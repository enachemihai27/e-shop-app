<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class StripeSettingController extends Controller
{


    public function update(Request $request, string $id){

        $request->validate([
            'status' => ['required', 'integer'],
            'mode' => ['required', 'integer'],
            'currency_name' => ['required', 'max:200'],
            'currency_rate' => ['required'],
            'client_id' => ['required'],
            'secret_key' => ['required']
        ]);

        StripeSetting::updateOrCreate(['id' => $id],[
            'status' => $request->status,
            'mode' => $request->mode,
            'country' => $request->country,
            'currency_name' => $request->currency_name,
            'currency_rate' => $request->currency_rate,
            'client_id' => $request->client_id,
            'secret_key' => $request->secret_key

        ]);


        toastr('Stripe settings update successfully!', 'success');

        return redirect()->back();

    }

}
