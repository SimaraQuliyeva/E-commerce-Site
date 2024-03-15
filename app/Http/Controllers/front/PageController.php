<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function product(Request $request){
        $size=$request->size ?? null;
        $color=$request->color ?? null;
        $startPrice=$request->start_price ?? null;
        $endPrice=$request->end_price ?? null;

       $products= Product::where('status','1')
           ->where(function ($q) use($size ,$color, $startPrice, $endPrice){
               if (!empty($size)){
                   $q->where('size', $size);
               }
               if (!empty($color)){
                   $q->where('color', $color);
               }
               if (!empty($startPrice) && $endPrice){
                   $q->whereBetween('price', [$startPrice, $endPrice]);
               }
               return $q;
           })
           ->paginate(20);

      $categories= Category::where('status', '1')->where('cat_child','null')->get();
        return view('front.pages.product',compact('products','categories'));

    }
    public function sale(){
        return view('front.pages.product');

    }
    public function productDetails($slug){
        $products= Product::where('slug',$slug)->first();
        return view('front.pages.product-details',compact('products'));

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
