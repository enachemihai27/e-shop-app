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
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $categoriesAndProducts = $this->getPopularCategory();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        return view('frontend.home.home',
            compact('sliders',
                'flashSaleDate',
                'flashSaleItems',
                'categoriesAndProducts',
                'brands'));
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
