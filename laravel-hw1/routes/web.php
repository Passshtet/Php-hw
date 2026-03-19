<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;

Route::get('/', [ToolController::class, 'index'])->name('tools.index');

Route::post('/store', [ToolController::class, 'store'])->name('tools.store');

Route::get('/search', [ToolController::class, 'search'])->name('tools.search');
