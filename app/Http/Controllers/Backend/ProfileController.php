<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    use ImageUploadHelper;

    public function index()
    {
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            'image' => ['image', 'max:2048']
        ]);

        $user = Auth::user();


        $imagePath = $this->uploadImage($request, 'image', '/uploads');

        $user->name = $request->name;
        $user->email = $request->email;

        if(!empty($imagePath)){
            $this->deleteImage($user->image);
        }

        $user->image = !empty($imagePath) ? $imagePath : $user->image;



        $user->save();


        return redirect()->back()->with('success', 'Profile update successfully!');
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back()->with('success', 'Profile password update successfully!');
    }
}
