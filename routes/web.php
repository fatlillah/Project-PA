<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderDetailSizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Production_costController;
use App\Http\Controllers\ProductionCostDetailController;
use App\Http\Controllers\ProductionThemeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
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

Route::get('kasir', function () {
    return 'halo kasir';
})->middleware(['auth', 'verified', 'role:kasir']);

Route::middleware(['auth', 'verified', 'role:admin|kasir'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // produk
    Route::get('/datatable/produks/data', [ProductController::class, 'data'])->name('produk.data');
    Route::post('/produk/delete-selected', [ProductController::class, 'deleteSelected'])->name('produk.delete_selected');
    Route::resource('produk', ProductController::class);

    // tema produksi
    Route::get('/datatable/tema-produksis/data', [ProductionThemeController::class, 'data'])->name('tema-produksi.data');
    Route::resource('tema-produksi', ProductionThemeController::class);

    // transaksi penjualan
    Route::get('/transaksi-penjualan/awal', [SaleController::class, 'create'])->name('transaksi-penjualan.awal');
    Route::post('/transaksi-penjualan/save', [SaleController::class, 'store'])->name('transaksi-penjualan.save');
    Route::get('/transaksi-penjualan/nota', [SaleController::class, 'nota'])->name('transaksi-penjualan.nota');

    //transaksi penjualan detail
    Route::get('/transaksi-penjualan/loadForm/{total}/{accepted}', [SaleDetailController::class, 'loadForm'])->name('transaksi-penjualan.loadForm');
    Route::get('/transaksi-penjualan/data/{id}', [SaleDetailController::class, 'data'])->name('transaksi-penjualan.data');
    Route::resource('transaksi-penjualan', SaleDetailController::class)
        ->except('show');

    // daftar penjualan
    Route::get('/daftar-penjualan/data', [SaleController::class, 'data'])->name('daftar-penjualan.data');
    Route::get('/daftar-penjualan', [SaleController::class, 'index'])->name('daftar-penjualan.index');
    Route::get('/daftar-penjualan/{id}', [SaleController::class, 'show'])->name('daftar-penjualan.show');
    Route::put('/daftar-penjualan/{id}', [SaleController::class, 'update'])->name('daftar-penjualan.update');
    Route::delete('/daftar-penjualan/{id}', [SaleController::class, 'destroy'])->name('daftar-penjualan.destroy');

    // ukuran detail pesanan
    Route::resource('ukuran-detail-pesanan', OrderDetailSizeController::class);

    // transaksi pemesanan
    Route::get('/transaksi-pemesanan/awal', [OrderController::class, 'create'])->name('transaksi-pemesanan.awal');
    Route::get('/transaksi-pemesanan/nota', [OrderController::class, 'nota'])->name('transaksi-pemesanan.nota');

    // transaksi pemesanan detail
    Route::get('/transaksi-pemesanan/loadForm/{DP}', [OrderDetailController::class, 'loadForm'])->name('transaksi-pemesanan.loadForm');
    Route::get('/transaksi-pemesanan/data/{id}', [OrderDetailController::class, 'data'])->name('transaksi-pemesanan.data');
    Route::resource('transaksi-pemesanan', OrderDetailController::class);
        
    // pengeluaran
    Route::get('/datatable/pengeluarans/data', [ExpenditureController::class, 'data'])->name('pengeluaran.data');
    Route::resource('pengeluaran', ExpenditureController::class);
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // user manajemen
    Route::get('/datatable/users/data', [UserController::class, 'data'])->name('users.data');
    Route::resource('users', UserController::class);

    // user profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // kategori produk
    Route::get('/datatable/kategoris/data', [CategoryController::class, 'data'])->name('kategori.data');
    Route::resource('kategori', CategoryController::class);

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

    //laporan pendapatan
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/data/{start_date}/{last_date}', [ReportController::class, 'data'])->name('laporan.data');
    Route::get('/laporan/pdf/{start_date}/{last_date}', [ReportController::class, 'exportPDF'])->name('laporan.export_pdf');
});
require __DIR__ . '/auth.php';
