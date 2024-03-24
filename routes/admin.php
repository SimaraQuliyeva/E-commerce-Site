<?php

use App\Http\Controllers\back\IndexController;
use App\Http\Controllers\back\SliderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['adminSetting'], 'prefix'=>'admin', 'as'=>'admin.'],function (){
    Route::get('/',[IndexController::class, 'index'])->name('index');
    Route::get('/slider',[SliderController::class, 'index'])->name('slider');
    Route::get('/slider/create',[SliderController::class, 'create'])->name('slider.create');
    Route::get('/slider/{id}/edit',[SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/slider/store',[SliderController::class, 'store'])->name('slider.store');
    Route::put('/slider/{id}/update',[SliderController::class, 'update'])->name('slider.update');
    Route::delete('/slider/{id}/delete',[SliderController::class, 'destroy'])->name('slider.destroy');

});

