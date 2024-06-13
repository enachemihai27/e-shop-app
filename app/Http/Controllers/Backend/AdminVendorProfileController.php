<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorProfileController extends Controller
{
    use ImageUploadHelper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        return view('admin.vendor-profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['image', 'max:3000', 'nullable'],
            'name' => ['required', 'max:200'],
            'phone' => ['required', 'max:50'],
            'email' => ['required','email' ,'max:200'],
            'address' => 'required',
            'description' => 'required',
            'fb_link' => ['nullable', 'url'],
            'inst_link' => ['nullable', 'url']
        ]);

        $vendor = Vendor::where('user_id', Auth::user()->id)->first();

        $imagePath = $this->updateImage($request, 'banner', 'uploads', $vendor->banner);


        $vendor->banner = empty(!$imagePath) ? $imagePath : $vendor->banner;
        $vendor->name = $request->name;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->fb_link = $request->fb_link;
        $vendor->inst_link = $request->inst_link;


        $vendor->save();

        toastr('Updated successfully!', 'success');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
