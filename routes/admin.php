<?php

use App\Http\Controllers\back\AboutController;
use App\Http\Controllers\back\CategoryController;
use App\Http\Controllers\back\ContactController;
use App\Http\Controllers\back\IndexController;
use App\Http\Controllers\back\SettingController;
use App\Http\Controllers\back\SliderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['adminSetting'], 'prefix'=>'admin', 'as'=>'admin.'],function (){
    Route::get('/',[IndexController::class, 'index'])->name('index');

    Route::get('/slider',[SliderController::class, 'index'])->name('slider');
    Route::get('/slider/create',[SliderController::class, 'create'])->name('slider.create');
    Route::get('/slider/{id}/edit',[SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/slider/store',[SliderController::class, 'store'])->name('slider.store');
    Route::delete('/slider/delete',[SliderController::class, 'destroy'])->name('slider.destroy');
    Route::post('/slider-status/update',[SliderController::class, 'status'])->name('slider.status');
    Route::put('/slider/{id}/update',[SliderController::class, 'update'])->name('slider.update');

    Route::resource('/category',CategoryController::class)->except('destroy');
    Route::delete('/category/delete',[CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/category-status/update',[CategoryController::class, 'status'])->name('category.status');


    Route::get('/about',[AboutController::class, 'index'])->name('about');
    Route::post('/about/update',[AboutController::class, 'update'])->name('about.update');

    Route::get('/contact',[ContactController::class, 'index'])->name('contact');
    Route::get('/contact/{id}/edit',[ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/{id}/update',[ContactController::class, 'update'])->name('contact.update');
    Route::delete('/contact/delete',[ContactController::class, 'destroy'])->name('contact.destroy');
    Route::post('/contact-status/update',[ContactController::class, 'status'])->name('contact.status');


    Route::get('/setting',[SettingController::class, 'index'])->name('setting');
    Route::get('/setting/create',[SettingController::class, 'create'])->name('setting.create');
    Route::post('/setting/store',[SettingController::class, 'store'])->name('setting.store');
    Route::get('/setting/{id}/edit',[SettingController::class, 'edit'])->name('setting.edit');
    Route::put('/setting/{id}/update',[SettingController::class, 'update'])->name('setting.update');
    Route::delete('/setting/delete',[SettingController::class, 'destroy'])->name('setting.destroy');

});

