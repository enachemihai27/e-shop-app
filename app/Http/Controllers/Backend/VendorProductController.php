<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use function Termwind\render;

class VendorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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


    public function getSubCategories(Request $request)
    {
        $subcategories = SubCategory::where('category_id',$request->id)->get();

        return $subcategories;
    }

    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id',$request->id)->get();

        return $childCategories;
    }


    public function changeStatus(Request $request){

        try {
            $product = Product::findOrFail($request->id);

            $product->status = $request->status === 'true' ? 1 : 0;
            $product->save();

            return response()->json(['message' => 'Status has been updated!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating status'], 500);
        }

    }
}
