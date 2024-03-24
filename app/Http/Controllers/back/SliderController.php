<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

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
        return view('back.pages.slider.create');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}