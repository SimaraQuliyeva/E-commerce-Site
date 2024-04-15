<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category:id, cat_child, name')->orderBy('id', 'desc')->paginate(20);
        return view('back.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('back.pages.products.edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(ProductRequest $request)
    {
        $imagePath = $request->file('image')->store('product_images', 'public');

        Product::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'content' => $request->input('content'),
            'quantity' => $request->input('quantity'),
            'color' => $request->input('color'),
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'details' => $request->input('details'),
            'image' => $imagePath ?? null,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::get();
        return view('back.pages.products.edit', compact('product', 'categories'));
//        $products = Category::where('cat_child', null)->get(); ancaq man/woman/child gorunsun category

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if (!empty($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        Product::where('id', $id)->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'content' => $request->input('content'),
            'quantity' => $request->input('quantity'),
            'color' => $request->input('color'),
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'details' => $request->input('details'),
            'image' => $imagePath ?? null,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = Product::where('id', $request->id)->firstOrFail();

        deleteFunc($product->image);
        $product->delete();
        return response(['error' => false, 'message' => 'Product deleted successfully']);

    }

    public function status(Request $request)
    {
        $update = $request->statu;
        $status = $update == 'true' ? true : false;

        Product::where('id', $request->id)->update(['status' => $status]);

        return response(['error' => false, 'status' => $status]);
    }
}
