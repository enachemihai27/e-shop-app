<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        $product = Product::findOrFail($request->product_id);


        //check product qty
        if($product->qty == 0){
            return response(['status' => 'error', 'message' => 'Product stock out!']);
        }elseif($product->qty < $request->qty){
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock!']);
        }


        $variants = [];
        $variantTotalAmount = 0;


        if ($request->has('variants_items')) {
            foreach ($request->variants_items as $item_id) {
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }

        //check discount for product
        $productPrice = 0;
        if (checkDiscount($product)) {
            $productPrice = $product->offer_price;
        } else {
            $productPrice = $product->price;
        }


        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;


        Cart::add($cartData);


        return response(['status' => 'success', 'message' => 'Added to card successfully!']);
    }


    public function cartDetails()
    {

        $cartItems = Cart::content();
        return view('frontend.pages.cart-detail', compact('cartItems'));

    }

    public function updateProductQty(Request $request)
    {

        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        //check product qty
        if($product->qty == 0){
            return response(['status' => 'error', 'message' => 'Product stock out!']);
        }elseif($product->qty < $request->quantity){
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock!']);
        }


        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getTotalProduct($request->rowId);

        return response(['status' => 'success', 'message' => 'Product quantity updated successfully!', 'product_total' => $productTotal]);
    }

    public function clearCart()
    {

        Cart::destroy();

        return response(['status' => 'success', 'message' => 'Product cart cleared updated successfully!']);
    }

    public function removeProduct($rowId)
    {
        Cart::remove($rowId);

        return redirect()->back();
    }


    /*Get product total*/
    public function getTotalProduct($rowId)
    {
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;

        return $total;
    }


    /*Get total total*/
    public function cartTotal()
    {
        $total = 0;
        foreach (Cart::content() as $product){
            $total += $this->getTotalProduct($product->rowId);
        }

        return $total;
    }

    /*Get cart count*/
    public function getCartCount()
    {
        return Cart::content()->count();

    }

    /*Get all cart products*/
    public function getCartProducts()
    {
        return Cart::content();
    }


    /*Remove sidebar Cart*/
    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);

        return response(['status' => 'success', 'message' => 'Product removed successfully!']);
    }



}
