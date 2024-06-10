<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
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

   /*Slider route*/
    Route::resource('slider', SliderController::class);

    /*Category route*/
    Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
    Route::resource('category', CategoryController::class);

    /*Sub Category route*/
    Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
    Route::resource('sub-category', SubCategoryController::class);


    /*Child Category route*/
    Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
    Route::get('get-subcategories', [ChildCategoryController::class, 'getSubcategory'])->name('get-subcategories');
    Route::resource('child-category', ChildCategoryController::class);


    /*Brand route*/
    Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
    Route::resource('brand', BrandController::class);

    /*Vendor profile route*/
    Route::resource('vendor-profile', AdminVendorProfileController::class);


});
