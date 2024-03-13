<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function product(){
        return view('front.pages.product');

    }
    public function sale(){
        return view('front.pages.product');

    }
    public function productDetails(){
        return view('front.pages.product-details');

    }
    public function about(){
        $about=About::all();
        return view('front.pages.about',compact('about'));

    }
    public function contact(){
    return view('front.pages.contact');
    }

    public function cart(){
        return view('front.pages.cart');
    }

}
