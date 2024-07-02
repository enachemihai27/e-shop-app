<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;

class PaypalSettingController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'status' => ['required', 'integer'],
            'mode' => ['required', 'integer'],
            'currency_name' => ['required', 'max:200'],
            'currency_rate' => ['required'],
            'client_id' => ['required'],
            'secret_key' => ['required']
        ]);

        PaypalSetting::updateOrCreate(['id' => $id],[
            'status' => $request->status,
            'mode' => $request->mode,
            'country' => $request->country,
            'currency_name' => $request->currency_name,
            'currency_rate' => $request->currency_rate,
            'client_id' => $request->client_id,
            'secret_key' => $request->secret_key

        ]);


        toastr('Paypal settings update successfully!', 'success');

        return redirect()->back();




    }

}
