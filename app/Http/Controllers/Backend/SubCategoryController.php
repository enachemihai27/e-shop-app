<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required', 'max:200', 'unique:sub_categories,name'],
            'status' => ['required']
        ]);

        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);;
        $subCategory->category_id = $request->category;
        $subCategory->status = $request->status;

        $subCategory->save();

        toastr('Created Successfully', 'success');

        return redirect()->route('admin.sub-category.index');


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
        $subCategory = SubCategory::findOrFail($id);

        $categories = Category::all();

        return view('admin.sub-category.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required', 'max:200', 'unique:sub_categories,name,'.$id],
            'status' => ['required']
        ]);

        $subCategory = SubCategory::findOrFail($id);
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);;
        $subCategory->category_id = $request->category;
        $subCategory->status = $request->status;

        $subCategory->save();

        toastr('Updated Successfully', 'success');

        return redirect()->route('admin.sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);


        $childCategory = ChildCategory::where('sub_category_id', $subcategory->id)->count();
        if($childCategory > 0){
            return response(['status' => 'error', 'message' =>  'This items contains sub items, for delete this you have to delete the sub items first!']);
        }

        $subcategory->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request){

        try {
            $subcategory = SubCategory::findOrFail($request->id);

            // Log the incoming request for debugging
            \Log::info('Request data:', $request->all());

            $subcategory->status = $request->status === 'true' ? 1 : 0;
            $subcategory->save();

            return response()->json(['message' => 'Status has been updated!']);
        } catch (\Exception $e) {
            \Log::error('Error updating status:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error updating status'], 500);
        }


    }
}
