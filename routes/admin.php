<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TransactionController;
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
    Route::put('products/change-status', [ProductController::class, 'changeStatus'])->name('products.change-status');
    Route::resource('products', ProductController::class);

   /* Product image gallery routes*/
    Route::resource('products-image-gallery', ProductImageGalleryController::class);


    /*Product variant routes*/
    Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
    Route::resource('products-variant', ProductVariantController::class);


   /* Product variant items routes*/
    Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');
    Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
    Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
    Route::get('products-variant-item-edit/{itemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
    Route::put('products-variant-item{itemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');
    Route::delete('products-variant-item/{itemId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
    Route::put('products-variant-item/change-status', [ProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');


    /* Seller Product variant routes*/
    Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
    Route::get('seller-pending-products', [SellerProductController::class, 'pendingProducts'])->name('seller-pending-products.index');
    Route::put('change-approve-status', [SellerProductController::class, 'changeApproveStatus'])->name('change-approve-status');


    /* Flash sale routes*/
    Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
    Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash-sale.update');
    Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
    Route::put('flash-sale/show_at_home/status-change', [FlashSaleController::class, 'changeShowAtHomeStatus'])->name('flash-sale.show-at-home.change-status');
    Route::put('flash-sale/change-status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale.change-status');
    Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destroy'])->name('flash-sale.destroy');


   /* Coupons routes*/
    Route::put('coupons/change-status', [CouponController::class, 'changeStatus'])->name('coupons.change-status');
    Route::resource('coupons', CouponController::class);


    /* Shipping routes*/
    Route::put('shipping-rules/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rules.change-status');
    Route::resource('shipping-rules', ShippingRuleController::class);

    /*Order routes*/
    Route::get('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment.status');
    Route::get('change-status', [OrderController::class, 'changeOrderStatus'])->name('order.change-status');
    Route::resource('order', OrderController::class);

    /*Order transaction routes*/
    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');

    /* General setting routes*/
    Route::get('settings', [SettingController::class, 'index'])->name('setting.index');
    Route::put('general-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting-update');

    /*Home page setting routes*/
    Route::get('home-page-setting', [HomePageSettingController::class, 'index'])->name('home-page-setting');
    Route::put('popular-category-section', [HomePageSettingController::class, 'updatePopularCategorySection'])->name('popular-category-section');
    Route::put('product-slider-section-one', [HomePageSettingController::class, 'updateProductSliderSectionOne'])->name('product-slider-section-one');
    Route::put('product-slider-section-two', [HomePageSettingController::class, 'updateProductSliderSectionTwo'])->name('product-slider-section-two');
    Route::put('product-slider-section-three', [HomePageSettingController::class, 'updateProductSliderSectionThree'])->name('product-slider-section-three');


   /* Payment settings routes*/
    Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
    Route::put('paypal-setting/{id}', [PaypalSettingController::class, 'update'])->name('paypal-setting.update');
    Route::put('stripe-setting/{id}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');





});
