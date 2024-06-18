<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable)
    {

        $flashSaleEndDate = FlashSale::first();

        $products = Product::where('is_approved', 1)->where('status', 1)->orderBy('id', 'DESC')->get();

        return $dataTable->render('admin.flash-sale.index', compact('flashSaleEndDate', 'products'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'end_date' => 'required'
        ]);

        FlashSale::updateOrCreate(
            ['id' => 1],
            ['end_date' => $request->end_date]
        );

        toastr('Updated successfully!', 'success');

        return redirect()->back();
    }


    public function addProduct(Request $request)
    {

        $request->validate([
            'product' => ['required','unique:flash_sale_items,product_id'],
            'show_at_home' => 'required',
            'status' => 'required'
        ], [
            'product.unique' => 'The product is already in flash sale!'
        ]);


        $flashSaleItem = new FlashSaleItem();
        $flashSaleItem->product_id = $request->product;
        $flashSaleItem->show_at_home = $request->show_at_home;
        $flashSaleItem->status = $request->status;
        $flashSaleItem->flash_sale_id = 1;
        $flashSaleItem->save();

        toastr('Product added successfully!', 'success');

        return redirect()->back();
    }

    public function changeShowAtHomeStatus(Request $request)
    {
        try {
            $item = FlashSaleItem::findOrFail($request->id);

            $item->show_at_home = $request->status === 'true' ? 1 : 0;
            $item->save();

            return response()->json(['message' => 'Status has been updated!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating status'], 500);
        }

    }

    public function changeStatus(Request $request)
    {

        try {
            $item = FlashSaleItem::findOrFail($request->id);

            $item->status = $request->status === 'true' ? 1 : 0;
            $item->save();

            return response()->json(['message' => 'Status has been updated!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating status'], 500);
        }

    }

    public function destroy(string $id)
    {
        $item = FlashSaleItem::findOrFail($id);
        $item->delete();

        return response(['status' => 'success', 'message' => 'Flash sale deleted successfully!']);
    }

}
