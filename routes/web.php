<?php

use App\Http\Controllers\IconController;
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

Route::get('/icon', [IconController::class, 'index']);
Route::get('/icon/data', [IconController::class, 'data'])->name('icon.data');
Route::post('/add-icon', [IconController::class, 'store'])->name('icon.store');
