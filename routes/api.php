<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'search']);

// Optional: Typeahead-style suggestions
Route::get('/search/suggestions', [SearchController::class, 'suggestions']);

// Optional: Admin search logs
Route::get('/search/logs', [SearchController::class, 'logs'])->middleware('auth.basic');

// Optional: Rebuild MeiliSearch index (admin-only, protected by middleware)
Route::post('/search/rebuild-index', [SearchController::class, 'rebuildIndex'])->middleware('auth.basic');