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
Route::get('belongsTo', [RelacaoContrler ::class, 'BelongsTo'])->name('BelongsTo');
Route::get('many-to-many', [RelacaoContrler ::class, 'ManyToMany'])->name('HasMany');
Route::get('running-queries',  [RelacaoContrler ::class, 'RunningQueries'])->name('RunningQueries');
Route::get('same-results',  [RelacaoContrler ::class, 'SameResults'])->name('SameResults');
Route::get('collections',  [RelacaoContrler ::class, 'Collections'])->name('collections');
