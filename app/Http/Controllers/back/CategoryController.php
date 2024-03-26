<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('category:id, cat_child, name')->get();
        return view('back.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('back.pages.category.edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(CategoryRequest $request)
    {
        $imagePath = $request->file('image')->store('category_images', 'public');

        Category::create([
            'name' => $request->input('name'),
            'cat_child' => $request->input('cat_child'),
            'content' => $request->input('content'),
            'image' => $imagePath ?? null,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Category added successfully!');
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
        $category = Category::where('id', $id)->first();
        $categories = Category::get();
        return view('back.pages.category.edit', compact('category', 'categories'));
//        $categories = Category::where('cat_child', null)->get(); ancaq man/woman/child gorunsun category

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            if (!empty($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('category_images', 'public');
        }

        Category::where('id', $id)->update([
            'name' => $request->input('name'),
            'cat_child' => $request->input('cat_child'),
            'content' => $request->input('content'),
            'image' => $imagePath ?? null,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id', $request->id)->firstOrFail();

        deleteFunc($category->image);
        $category->delete();
        return response(['error' => false, 'message' => 'Category deleted successfully']);

    }

    public function status(Request $request)
    {
        $update = $request->statu;
        $status = $update == 'true' ? true : false;

        Category::where('id', $request->id)->update(['status' => $status]);

        return response(['error' => false, 'status' => $status]);
    }
}
