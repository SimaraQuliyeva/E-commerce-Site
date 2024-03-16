<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Slider;

class IndexController extends Controller
{
    public function index(){
        $slider=Slider::all();
//        dd($slider);
        $about=About::where('id', 1)->get();
        return view('front.pages.index', compact('slider', 'about'));
    }
}
