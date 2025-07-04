<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentViewController;

Route::get('/', function () {
    return view('search');
});


Route::get('/blog/{id}', [ContentViewController::class, 'blog']);
Route::get('/product/{id}', [ContentViewController::class, 'product']);
Route::get('/page/{id}', [ContentViewController::class, 'page']);
Route::get('/faq/{id}', [ContentViewController::class, 'faq']);