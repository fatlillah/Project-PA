<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Production_costController;
use App\Http\Controllers\ProductionCostDetailController;
use App\Http\Controllers\ProductionThemeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
// user manajemen
Route::get('/datatable/users/data', [UserController::class, 'data'])->name('user.data');
Route::resource('user', UserController::class);

Route::get('kasir', function () {
    return 'halo kasir';
})->middleware(['auth', 'verified', 'role:kasir']);

Route::middleware(['auth', 'verified', 'role:admin|kasir'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

// produk
Route::get('/datatable/produks/data', [ProductController::class, 'data'])->name('produk.data');
Route::post('/produk/delete-selected', [ProductController::class, 'deleteSelected'])->name('produk.delete_selected');
Route::resource('produk', ProductController::class);

// pengeluaran
Route::get('/datatable/pengeluarans/data', [ExpenditureController::class, 'data'])->name('pengeluaran.data');
Route::resource('pengeluaran', ExpenditureController::class);
});

// user profil
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// kategori produk
    Route::get('/datatable/kategoris/data', [CategoryController::class, 'data'])->name('kategori.data');
    Route::resource('kategori', CategoryController::class);

// tema produksi
    Route::get('/datatable/tema-produksis/data', [ProductionThemeController::class, 'data'])->name('tema-produksi.data');
    Route::resource('tema-produksi', ProductionThemeController::class);

// biaya produksi
    Route::get('/produksi/create/{id}', [Production_costController::class, 'create'])->name('produksi.create');
    Route::get('/datatable/produksis/data', [Production_costController::class, 'data'])->name('produksi.data');
    Route::resource('produksi', Production_costController::class)
        ->except('create');

// biaya produksi detail
    Route::get('/datatable/produksi-details/data/{id}', [ProductionCostDetailController::class, 'data'])->name('produksi-detail.data');
    Route::get('/produksi-detail/loadForm/{grand_total}', [ProductionCostDetailController::class, 'loadForm'])->name('produksi-detail.loadForm');
    Route::resource('produksi-detail', ProductionCostDetailController::class)
        ->except('create', 'show', 'edit');
});

require __DIR__ . '/auth.php';
