<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController AS CA;
use App\Http\Controllers\productController AS PR;

////Route::prefix('user/categories')->group(function () {
//    Route::get('/', [CA::class ,'index'])->name('categories');
//    Route::get('/create', [CA::class ,'create'])->name('categories.create');
//    Route::post('/store', [CA::class ,'store'])->name('categories.store');
//    Route::get('/edit/{category}', [CA::class ,'edit'])->name('.categories.edit')->middleware('checkrole');
//    Route::post('/update/{category}', [CA::class ,'update'])->name('categories.update');
//    Route::get('/destroy/{category}', [CA::class ,'destroy'])->name('categories.destroy');
////});


//Route::prefix('user/products')->middleware('checkrole')->group(function () {
    Route::get('/', [PR::class , 'index'])->name('products');
    Route::get('/create', [PR::class ,'create'])->name('products.create');
    Route::post('/store', [PR::class ,'store'])->name('products.store');
    Route::get('/edit/{products}', [PR::class,'edit'])->name('products.edit');
    Route::post('/update/{products}', [PR::class,'update'])->name('products.update');
    Route::get('/destroy/{products}', [PR::class,'destroy'])->name('products.destroy');

//});
