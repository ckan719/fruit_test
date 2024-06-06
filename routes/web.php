<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FruitCategoryController;
use App\Http\Controllers\FruitCategoryNoteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'authenticate'])->name('authenticate');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('fruit_categories', FruitCategoryController::class);
    Route::resource('fruit_category_notes', FruitCategoryNoteController::class);
    Route::resource('orders', OrderController::class);
});
