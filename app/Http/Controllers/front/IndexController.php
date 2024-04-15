<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class IndexController extends Controller
{
    public function index(){
        $slider = Slider::where('status', 1)->get();
//        dd($slider);
        $about=About::where('id', 1)->get();
        $lastProducts=Product::where('status', '1')->select('id','name', 'slug','size', 'color','price','category_id', 'image')
            ->orderBy('id','desc')->limit(10)->get();
        return view('front.pages.index', compact('slider', 'about','lastProducts'));
    }
}
