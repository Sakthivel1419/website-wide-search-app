<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'search']);

Route::get('/search/suggestions', [SearchController::class, 'suggestions']);

Route::get('/search/logs', [SearchController::class, 'logs'])->middleware('auth.basic');

Route::post('/search/rebuild-index', [SearchController::class, 'rebuildIndex'])->middleware('auth.basic');