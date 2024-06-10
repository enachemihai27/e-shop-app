<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();

        return view('admin.child-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'sub_category' => ['required'],
            'name' => ['required', 'max:200', 'unique:child_categories,name'],
            'status' => ['required']
        ]);

        $childCategory = new ChildCategory();
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);;
        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->sub_category;
        $childCategory->status = $request->status;

        $childCategory->save();

        toastr('Created Successfully', 'success');

        return redirect()->route('admin.child-category.index');
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
        $categories = Category::all();
        $childCategory = ChildCategory::findOrFail($id);
        $subcategories = SubCategory::where('category_id', $childCategory->category_id)->get();

        return view('admin.child-category.edit', compact('categories', 'childCategory', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => ['required'],
            'sub_category' => ['required'],
            'name' => ['required', 'max:200', 'unique:child_categories,name,' . $id],
            'status' => ['required']
        ]);

        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);;
        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->sub_category;
        $childCategory->status = $request->status;

        $childCategory->save();

        toastr('Updated Successfully', 'success');

        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->delete();

        return response(['status' => 'success', 'message' => 'De;eted Successfully!']);
    }


    /**
     * Get sub categories
     */
    public function getSubcategory(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();

        return $subCategories;
    }


    public function changeStatus(Request $request)
    {
        try {
            $category = ChildCategory::findOrFail($request->id);

            // Log the incoming request for debugging
            \Log::info('Request data:', $request->all());

            $category->status = $request->status === 'true' ? 1 : 0;
            $category->save();

            return response()->json(['message' => 'Status has been updated!']);
        } catch (\Exception $e) {
            \Log::error('Error updating status:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error updating status'], 500);
        }
    }
}
