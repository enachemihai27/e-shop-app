<?php

namespace App\Http\Controllers\Backend;


use App\DataTables\GalleryImageDataTable;
use App\DataTables\ProductImageGalleryDataTable;
use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;

use Illuminate\Http\Request;

class ProductImageGalleryController extends Controller
{
    use ImageUploadHelper;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductImageGalleryDataTable $dataTable, Request $request)
    {

        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.product.image-gallery.index', compact('product'));
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
            'image.*' => ['required', 'image', 'max:2048'],
        ]);


        $imagePaths = $this->uploadMultiImages($request, 'image', 'uploads');

        if ($imagePaths != null) {
            foreach ($imagePaths as $path) {
                $productImageGallery = new ProductImageGallery();
                $productImageGallery->image = $path;
                $productImageGallery->product_id = $request->product;
                $productImageGallery->save();
            }
        }

        toastr('Uploaded successfully!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public
    function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galleryImage = ProductImageGallery::findOrFail($id);

        $this->deleteImage($galleryImage->image);

        $galleryImage->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
