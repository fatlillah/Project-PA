<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('kasir', function () {
    return 'halo kasir';
})->middleware(['auth', 'verified', 'role:kasir']);


Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    
    Route::resource('icon', IconController::class);
    Route::get('/datatable/icons/data', [IconController::class, 'data'])->name('icon.data');
    Route::resource('menu', MenuController::class);
    Route::get('/datatable/menus/data', [MenuController::class, 'data'])->name('menu.data');
    Route::resource('kategori', CategoryController::class);
    Route::get('/datatable/kategoris/data', [CategoryController::class, 'data'])->name('kategori.data');
    Route::resource('produk', ProductController::class);
    Route::get('/datatable/produks/data', [ProductController::class, 'data'])->name('produk.data');
});

require __DIR__ . '/auth.php';
