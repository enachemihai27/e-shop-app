<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class VendorProductVariantItemController extends Controller
{
    public function index(VendorProductVariantItemDataTable $dataTable, $productId, $variantId){


        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);

        return $dataTable->render('vendor.product.variant-item.index', compact('product', 'variant'));

    }

    public function create (string $productId, string $variantId){

        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return view('vendor.product.variant-item.create', compact('product','variant'));

    }

    public function store (Request $request){

        $request->validate([
            'variant_id' => ['integer', 'required'],
            'item_name' => ['required', 'max:200'],
            'item_price' => ['integer'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $item = new ProductVariantItem();
        $item->product_variant_id = $request->variant_id;
        $item->name = $request->item_name;
        $item->price = $request->item_price;
        $item->is_default = $request->is_default;
        $item->status = $request->status;

        $item->save();

        toastr('Created successfully!', 'success');


        return redirect()->route('vendor.products-variant-item.index', ['productId' => $request->product_id , 'variantId' => $request->variant_id]);
    }

    public function edit(string $id){

        $item = ProductVariantItem::findOrFail($id);
        return view('vendor.product.variant-item.edit', compact('item'));


    }


    public function update(Request $request, string $id){

        $request->validate([

            'item_name' => ['required', 'max:200'],
            'item_price' => ['integer'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $item = ProductVariantItem::findOrFail($id);

        $item->name = $request->item_name;
        $item->price = $request->item_price;
        $item->is_default = $request->is_default;
        $item->status = $request->status;
        $item->save();

        toastr('Updated successfully!', 'success');


        return redirect()->route('vendor.products-variant-item.index',
            ['productId' => $item->productVariant->product_id , 'variantId' => $item->product_variant_id]);
    }




    public function destroy(string $id){

        $item = ProductVariantItem::findOrFail($id);

        $item->delete();

        return response(['status' => 'success', 'message' => 'Product variant item deleted successfully!']);

    }


    public function changeStatus(Request $request){

        try {
            $item = ProductVariantItem::findOrFail($request->id);

            $item->status = $request->status === 'true' ? 1 : 0;
            $item->save();

            return response()->json(['message' => 'Status has been updated!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating status'], 500);
        }

    }
}
