<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRuleDataTable $dataTable)
    {
        return $dataTable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'type' => ['required'],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required']
        ]);

        $rule = new ShippingRule();
        $rule->name = $request->name;
        $rule->type = $request->type;
        $rule->min_cost = $request->min_cost;
        $rule->cost = $request->cost;
        $rule->status = $request->status;

        $rule->save();

        toastr('Rule created Successfully', 'success');

        return redirect()->route('admin.shipping-rules.index');
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
        $rule = ShippingRule::findOrFail($id);

        return view('admin.shipping-rule.edit', compact('rule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'type' => ['required'],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required']
        ]);

        $rule = ShippingRule::findOrFail($id);
        $rule->name = $request->name;
        $rule->type = $request->type;
        $rule->min_cost = $request->min_cost;
        $rule->cost = $request->cost;
        $rule->status = $request->status;

        $rule->save();

        toastr('Rule updated Successfully', 'success');

        return redirect()->route('admin.shipping-rules.index');
    }

    public function changeStatus(Request $request)
    {

        try {
            $rule = ShippingRule::findOrFail($request->id);

            $rule->status = $request->status === 'true' ? 1 : 0;
            $rule->save();

            return response()->json(['message' => 'Status has been updated!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating status'], 500);
        }

    }

    public function destroy(string $id)
    {
        $rule = ShippingRule::findOrFail($id);
        $rule->delete();

        return response(['status' => 'success', 'message' => 'Flash sale deleted successfully!']);
    }

}
