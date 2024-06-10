<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required','not_in:empty'],
            'name' => ['required','max:200', 'unique:categories,name'],
            'status' => ['required', 'integer']
        ]);

        $category = new Category();


        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;

        $category->save();

        toastr('Created Successfully', 'success');

        return redirect()->route('admin.category.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required','not_in:empty'],
            'name' => ['required','max:200', 'unique:categories,name,'.$id],
            'status' => ['required', 'integer']
        ]);

        $category = Category::findOrFail($id);


        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;

        $category->save();

        toastr('Updated Successfully', 'success');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $subCategory = SubCategory::where('category_id', $category->id)->count();
        if($subCategory > 0){
            return response(['status' => 'error', 'message' =>  'This items contains sub items, for delete this you have to delete the sub items first!']);
        }


        $category->delete();


        return response(['status' => 'success', 'message' =>  'Deleted Successfully!']);
    }

    public function changeStatus(Request $request){

        try {
            $category = Category::findOrFail($request->id);

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
