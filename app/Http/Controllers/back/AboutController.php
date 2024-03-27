<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about=About::where('id',1)->first();
        return view('back.pages.about.edit',compact('about'));
    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id=1)
    {
        if ($request->hasFile('image')) {
            if (!empty($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('about_images', 'public');
        }

        About::updateOrCreate(
            ['id'=>$id],
            [
                'name'=>$request->name,
//                'content'=>$request->content,
                'text1_icon'=>$request->text1_icon,
                'text1_header'=>$request->text1_header,
                'text1_content'=>$request->text1_content,
                'text2_icon'=>$request->text2_icon,
                'text2_header'=>$request->text2_header,
                'text2_content'=>$request->text2_content,
                'text3_icon'=>$request->text3_icon,
                'text3_header'=>$request->text3_header,
                'text3_content'=>$request->text3_content,
                'image'=>$imagePath ?? null,
//                'status'=>$request->status,
            ]

        );
        return redirect()->route('admin.about')->with('success', 'About updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
}
