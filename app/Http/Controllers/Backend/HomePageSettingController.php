<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSetting;
use Flasher\Laravel\Facade\Flasher;
use Flasher\Prime\Factory\FlasherFactory;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function index()
    {


        $categories = Category::where('status', 1)->get();

        $popularCategorySection = HomePageSetting::where('key', 'popular_category_section')->first();

        $slicerSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();

        $slicerSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();

        return view("admin.home-page-setting.index", compact('categories', 'popularCategorySection', 'slicerSectionOne', 'slicerSectionTwo'));
    }


    public function updatePopularCategorySection(Request $request)
    {

        $request->validate([
            'category_1' => ['required'],
            'category_2' => ['required'],
            'category_3' => ['required'],
            'category_4' => ['required']
        ],
            ['category_1.required' => 'Category one filed is required'],
            ['category_2.required' => 'Category two filed is required'],
            ['category_3.required' => 'Category three filed is required'],
            ['category_4.required' => 'Category four filed is required']
        );

        $data = [
            [
                'category' => $request->category_1,
                'sub_category' => $request->sub_category_1,
                'child_category' => $request->child_category_1,
            ],
            [
                'category' => $request->category_2,
                'sub_category' => $request->sub_category_2,
                'child_category' => $request->child_category_2,
            ],
            [
                'category' => $request->category_3,
                'sub_category' => $request->sub_category_3,
                'child_category' => $request->child_category_3,
            ],
            [
                'category' => $request->category_4,
                'sub_category' => $request->sub_category_4,
                'child_category' => $request->child_category_4,
            ]

        ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'popular_category_section'
            ],
            [
                'value' => json_encode($data)

            ]
        );


        toastr('Success', 'success');


        return redirect()->back()->with('message', 'Success');

    }

    public function updateProductSliderSectionOne (Request $request){


        $request->validate([
            'category_1' => ['required']
        ],
        ['category_1.required' => 'Category filed is required']
        );

        $data = [
                'category' => $request->category_1,
                'sub_category' => $request->sub_category_1,
                'child_category' => $request->child_category_1,
        ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_one'
            ],
            [
                'value' => json_encode($data)

            ]
        );


        toastr('Success', 'success');


        return redirect()->back()->with('message', 'Success');


    }


    public function updateProductSliderSectionTwo (Request $request){


        $request->validate([
            'category_1' => ['required']
        ],
            ['category_1.required' => 'Category filed is required']
        );

        $data = [
            'category' => $request->category_1,
            'sub_category' => $request->sub_category_1,
            'child_category' => $request->child_category_1,
        ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_two'
            ],
            [
                'value' => json_encode($data)

            ]
        );


        toastr('Success', 'success');


        return redirect()->back()->with('message', 'Success');


    }


}
