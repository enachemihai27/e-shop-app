<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;


class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $categoriesAndProducts = $this->getPopularCategory();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        $typeBaseProduct = $this->getTypeBaseProduct();
        $categoryProductSliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();

        return view('frontend.home.home',
            compact('sliders',
                'flashSaleDate',
                'flashSaleItems',
                'categoriesAndProducts',
                'brands',
                'typeBaseProduct',
                'categoryProductSliderSectionOne'));
    }

    private function getTypeBaseProduct(){
        $typeBaseProduct = [];

        $newArrival = Product::where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $featuredProduct = Product::where(['product_type' => 'featured', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $topProduct = Product::where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $bestProduct = Product::where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();


        $typeBaseProduct['new_arrival'] = $newArrival;
        $typeBaseProduct['featured_product'] = $featuredProduct;
        $typeBaseProduct['top_product'] = $topProduct;
        $typeBaseProduct['best_product'] = $bestProduct;

        return $typeBaseProduct;
    }


    private function getPopularCategory()
    {
        $popularCategories = HomePageSetting::where('key', 'popular_category_section')->first();
        $popularCategories = json_decode($popularCategories->value, true);

        $categoriesAndProducts = [];

        foreach ($popularCategories as $popularCategory) {
            $lastKey = [];
            foreach ($popularCategory as $key => $category) {
                if ($category == null) {
                    break;
                }
                $lastKey = [$key => $category];
            }

            if (!empty($lastKey)) {
                $key = array_keys($lastKey)[0];
                $value = array_values($lastKey)[0];

                try {
                    if ($key === 'category') {
                        $category = Category::findOrFail($value);
                        $products = Product::where('category_id', $category->id)
                            ->take(12)
                            ->orderBy('id', 'DESC')
                            ->get();
                    } elseif ($key === 'sub_category') {
                        $category = SubCategory::findOrFail($value);
                        $products = Product::where('sub_category_id', $category->id)
                            ->take(12)
                            ->orderBy('id', 'DESC')
                            ->get();
                    } else {
                        $category = ChildCategory::findOrFail($value);
                        $products = Product::where('child_category_id', $category->id)
                            ->take(12)
                            ->orderBy('id', 'DESC')
                            ->get();
                    }

                    $categoriesAndProducts[] = [
                        'category' => $category,
                        'products' => $products
                    ];
                } catch (Exception $e) {
                    continue;
                }
            }
        }

        return $categoriesAndProducts;
    }
}
