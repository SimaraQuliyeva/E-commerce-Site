<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\front\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware'=>'setting'],function (){
    Route::get('/',[IndexController::class, 'index'])->name('front.index');
    Route::get('/product',[PageController::class, 'product'])->name('front.product');
    Route::get('/product/man',[PageController::class, 'product'])->name('front.men-product');
    Route::get('/product/woman',[PageController::class, 'product'])->name('front.women-product');
    Route::get('/product/child',[PageController::class, 'product'])->name('front.children-product');
    Route::get('/product/sale',[PageController::class, 'sale'])->name('front.sale-product');

    Route::get('/product/{slug}',[PageController::class, 'productDetails'])->name('front.product.details');

    Route::get('/about',[PageController::class, 'about'])->name('front.about');
    Route::get('/contact',[PageController::class, 'contact'])->name('front.contact');
    Route::post('/contact',[AjaxController::class, 'contactSave'])->name('front.contact.post');
    Route::get('/cart',[PageController::class, 'cart'])->name('front.cart');

});

