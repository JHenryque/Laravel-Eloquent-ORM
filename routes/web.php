<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::view('/','home');
Route::get('/teste', function () {
    $products = Product::all();
    echo '<pre>';
    print_r($products->toArray());
});

