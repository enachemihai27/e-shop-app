<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use Illuminate\Support\Facades\Route;

/*Admin Routes*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    /*Profile routes*/
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

   /*Slider routes*/
    Route::resource('slider', SliderController::class);

    /*Category routes*/
    Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
    Route::resource('category', CategoryController::class);

    /*Sub Category routes*/
    Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
    Route::resource('sub-category', SubCategoryController::class);


    /*Child Category routes*/
    Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
    Route::get('get-subcategories', [ChildCategoryController::class, 'getSubcategory'])->name('get-subcategories');
    Route::resource('child-category', ChildCategoryController::class);


    /*Brand routes*/
    Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
    Route::resource('brand', BrandController::class);

    /*Vendor profile routes*/
    Route::resource('vendor-profile', AdminVendorProfileController::class);

    /*Products routes*/
    Route::get('products/get-sub-categories', [ProductController::class, 'getSubCategories'])->name('products.get-sub-categories');
    Route::get('products/get-child-categories', [ProductController::class, 'getChildCategories'])->name('products.get-child-categories');
    Route::resource('products', ProductController::class);


});
