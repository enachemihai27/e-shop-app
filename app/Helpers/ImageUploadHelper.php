<?php

namespace App\Helpers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadHelper
{

    public function uploadImage(Request $request, $inputName, $path)
    {
        if ($request->hasFile($inputName)) {
            $image = $request->{$inputName};
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path($path), $imageName);
            return $path . '/' . $imageName;
        }
    }


    public function uploadMultiImages(Request $request, $inputName, $path)
    {
        $paths = [];
        if ($request->hasFile($inputName)) {
            $images = $request->{$inputName};

            if ($images != null) {
                foreach ($images as $image) {
                    $imageName = rand() . '_' . $image->getClientOriginalName();
                    $image->move(public_path($path), $imageName);

                    $paths[] = $path . '/' . $imageName;
                }
            }
            return $paths;
        }
    }


    public function updateImage(Request $request, $inputName, $path, $oldPath = null)
    {
        if ($request->hasFile($inputName)) {
            $this->deleteImage($oldPath);
            $image = $request->{$inputName};
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path($path), $imageName);
            return $path . '/' . $imageName;
        }
    }

    public function deleteImage(string $path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
