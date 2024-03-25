<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $sliders= Slider::all();
        return view('back.pages.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.slider.edit');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(SliderRequest $request)
    {
        $imagePath = $request->file('image')->store('slider_images', 'public');

        Slider::create([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'link' => $request->input('link') ?? null,
            'image' => $imagePath ?? null,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.slider')->with('success', 'Slider added successfully!');
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
       $slider= Slider::where('id', $id)->first();
        return view('back.pages.slider.edit',compact('slider'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id);
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            $slider->image = $request->file('image')->store('slider_images', 'public');
        }
        Slider::where('id', $id)->update([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'link' => $request->input('link') ?? null,
            'image' => $imagePath ?? null,
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.slider')->with('success', 'Slider updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::where('id', $id)->firstOrFail();

        if (!empty($slider->image) && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();
        return redirect()->route('admin.slider')->with('error', 'Slider deleted successfully!');

    }

    public function status(Request $request)
    {
        $update = $request->statu;
        $status = $update == 'true' ? true : false;

        Slider::where('id', $request->id)->update(['status' => $status]);

        return response(['error' => false, 'status' => $status]);
    }

}
