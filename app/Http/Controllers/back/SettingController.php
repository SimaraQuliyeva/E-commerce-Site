<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings=Setting::get();
        return view('back.pages.settings.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.settings.edit');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Setting::create([
            'address' => $request->input('address') ?? null,
            'phone' => $request->input('phone') ?? null,
            'email' => $request->input('email'),
            'set_type' => $request->input('set_type'),
        ]);
        return redirect()->route('admin.setting')->with('success', 'Setting added successfully!');

    }

    public function edit(string $id)
    {
        $setting= Setting::where('id', $id)->first();
        return view('back.pages.settings.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $setting= Setting::where('id', $id)->first();
        $setting = Setting::findOrFail($id);

        Setting::where('id', $id)->update([
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('admin.setting')->with('success', 'Settings updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $setting = Setting::where('id', $request->id)->firstOrFail();

//        deleteFunc($setting->image);
        $setting->delete();
        return response(['error'=>false, 'message'=>'Settings deleted successfully']);
    }
}
