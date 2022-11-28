<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;


Route::get('/', function () {
    return view('welcome');
});

//Routes
Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/add-category', [CategoryController::class, 'create']);
    Route::post('/add-category', [CategoryController::class, 'store']);
    Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit']);
    Route::put('/update-category/{category_id}', [CategoryController::class, 'update']);
    Route::get('/delete-category/{category_id}', [CategoryController::class, 'destroy']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
