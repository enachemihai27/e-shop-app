<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
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

});
