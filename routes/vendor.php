<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use Illuminate\Support\Facades\Route;

/*Vendor Routes*/
Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->as('vendor.')->group(function () {

    Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');

    Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
    Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

    /*Vendor shop profile routes*/
    Route::resource('shop-profile', VendorShopProfileController::class);

    /*Vendor products controller*/
    Route::get('products/get-sub-categories', [VendorProductController::class, 'getSubCategories'])->name('products.get-sub-categories');
    Route::get('products/get-child-categories', [VendorProductController::class, 'getChildCategories'])->name('products.get-child-categories');
    Route::put('products/change-status', [VendorProductController::class, 'changeStatus'])->name('products.change-status');
    Route::resource('products', VendorProductController::class);



    /* Vendor image gallery routes*/
    Route::resource('products-image-gallery', VendorProductImageGalleryController::class);



    /*Product variant routes*/
    Route::put('products-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
    Route::resource('products-variant', VendorProductVariantController::class);


    /* Product variant items routes*/
    Route::get('products-variant-item/{productId}/{variantId}', [VendorProductVariantItemController::class, 'index'])->name('products-variant-item.index');
    Route::get('products-variant-item/create/{productId}/{variantId}', [VendorProductVariantItemController::class, 'create'])->name('products-variant-item.create');
    Route::post('products-variant-item', [VendorProductVariantItemController::class, 'store'])->name('products-variant-item.store');
    Route::get('products-variant-item-edit/{itemId}', [VendorProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
    Route::put('products-variant-item{itemId}', [VendorProductVariantItemController::class, 'update'])->name('products-variant-item.update');
    Route::delete('products-variant-item/{itemId}', [VendorProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
    Route::put('products-variant-item/change-status', [VendorProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');



    /*Orders routes*/
    Route::get('orders', [VendorOrderController::class, 'index'])->name('orders.index');
    Route::get('order/show/{id}', [VendorOrderController::class, 'show'])->name('order.show');
    Route::get('order/status/{id}', [VendorOrderController::class, 'orderStatus'])->name('order.status');
});
