<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('admin.dashboard');
});


Route::resource('icon', IconController::class);
Route::get('/datatable/icons/data', [IconController::class, 'data'])->name('icon.data');
Route::resource('menu', MenuController::class);
Route::get('/datatable/menus/data', [MenuController::class, 'data'])->name('menu.data');
Route::resource('kategori', CategoryController::class);
Route::get('/datatable/kategoris/data', [CategoryController::class, 'data'])->name('kategori.data');
Route::resource('produk', ProductController::class);
Route::get('/datatable/produks/data', [ProductController::class, 'data'])->name('produk.data');
