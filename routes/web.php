<?php

use App\Http\Controllers\MainController;
use App\Models\Product;
use App\Http\Controllers\RelacaoContrler;
use Illuminate\Support\Facades\Route;

Route::view('/','home');
Route::get('/teste', function () {
    $products = Product::all();
    echo '<pre>';
    print_r($products->toArray());
});

Route::get('/orm', [MainController::class, 'index'])->name('orm');
Route::get('relacao', [RelacaoContrler ::class, 'index'])->name('relacao');
Route::get('one-to-one', [RelacaoContrler ::class, 'oneToOne'])->name('one-to-one');
Route::get('one-to-many', [RelacaoContrler ::class, 'oneToMany'])->name('one-to-many');
