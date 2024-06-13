<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $dataTable, $productId, $variantId){


        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);

        return $dataTable->render('admin.product.variant-item.index', compact('product', 'variant'));

    }

    public function create (string $productId, string $variantId){

        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return view('admin.product.variant-item.create', compact('product','variant'));

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


        return redirect()->route('admin.products-variant-item.index', ['productId' => $request->product_id , 'variantId' => $request->variant_id]);
    }

    public function edit(string $id){

        $item = ProductVariantItem::findOrFail($id);


        return view('admin.product.variant-item.edit', compact('item'));


    }

    public function destroy(string $id){


    }
}
