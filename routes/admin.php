<?php

use App\Http\Controllers\back\IndexController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'adminSetting', 'prefix'=>'admin', 'as'=>'admin.'],function (){
    Route::get('/',[IndexController::class, 'index'])->name('admin.index');

});

