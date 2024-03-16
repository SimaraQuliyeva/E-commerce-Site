<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function product(Request $request)
    {
        $size = $request->size ?? null;
        $color = $request->color ?? null;
        $startPrice = $request->start_price ?? null;
        $endPrice = $request->end_price ?? null;

        $orderBy = $request->orderBy ?? 'id';
        $short = $request->short ?? 'desc';

        $products = Product::where('status', '1')->select(['id', 'name', 'slug', 'size', 'color', 'price', 'category_id', 'image'])
            ->where(function ($q) use ($size, $color, $startPrice, $endPrice) {
                if (!empty($size)) {
                    $q->where('size', $size);
                }
                if (!empty($color)) {
                    $q->where('color', $color);
                }
                if (!empty($startPrice) && $endPrice) {
                    $q->whereBetween('price', [$startPrice, $endPrice]);
                }
                return $q;
            })
            ->with('category:id,name,slug');
        $minPrice = $products->min('price');
        $maxPrice = $products->max('price');

        $sizeList =  Product::where('status', '1')->groupBy('size')->pluck('size')->toArray();

        $colors =  Product::where('status', '1')->groupBy('color')->pluck('color')->toArray();


        $products = $products->orderBy($orderBy, $short)->paginate(20);

        $categories = Category::where('status', '1')->where('cat_child', null)->withCount('products')->get();
        return view('front.pages.product', compact('products', 'categories',
            'minPrice', 'maxPrice', 'sizeList', 'colors'));

    }

    public function sale()
    {
        return view('front.pages.product');

    }

    public function productDetails($slug)
    {
        $products = Product::where('slug', $slug)->first();
        return view('front.pages.product-details', compact('products'));

    }

    public function about()
    {
        $about = About::all();
        return view('front.pages.about', compact('about'));

    }

    public function contact()
    {
        return view('front.pages.contact');
    }

    public function cart()
    {
        return view('front.pages.cart');
    }

}
