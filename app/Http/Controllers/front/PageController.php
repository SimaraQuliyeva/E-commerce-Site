<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function product(Request $request, $slug=null)
    {
        $category=request()->segment(1) ?? null;
        $size = !empty($request->size) ? explode(',',$request->size) : null;
        $color = !empty($request->color) ? explode(',',$request->color) : null;
        $startPrice = $request->min ?? null;
        $endPrice = $request->max ?? null;

        $orderBy = $request->orderBy ?? 'id';
        $sort = $request->sort ?? 'desc';
//        dd($endPrice);

       $products = Product::where('status', '1')->select(['id', 'name', 'slug', 'size', 'color', 'price', 'category_id', 'image'])
            ->where(function ($q) use ($size, $color, $startPrice, $endPrice) {
                if (!empty($size)) {
                    $q->whereIn('size', $size);
                }
                if (!empty($color)) {
                    $q->whereIn('color', $color);
                }
                if (!empty($startPrice) && $endPrice) {
//                    $q->whereBetween('price', [$startPrice, $endPrice]);
                    $q->where('price','>=',$startPrice);
                    $q->where('price','<=',$endPrice);
                }
                return $q;
            })
            ->with('category:id,name,slug')
            ->whereHas('category', function ($query) use($category, $slug){
                if(!empty($slug)){
                $query->where('slug', $slug);
                }
                return $query;
            })->orderBy($orderBy, $sort)->paginate(21);

//        $minPrice = $products->min('price');
//        $maxPrice = $products->max('price');

        if($request->ajax()){
            $view=view('front.ajax.productList',compact('products'))->render();
            return response(['data'=>$view, 'paginate'=>(string) $products->links()]);
        }
        $sizeList =  Product::where('status', '1')->groupBy('size')->pluck('size')->toArray();

        $colors =  Product::where('status', '1')->groupBy('color')->pluck('color')->toArray();

//        $products = $products;

        $maxPrice = Product::max('price');

//        $categories= Category::where('status', '1')->where('cat_child', null)->withCount('products')->get();

        return view('front.pages.product', compact('products',
             'maxPrice', 'sizeList', 'colors'));

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


}
