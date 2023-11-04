<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\auth\AdminAuthController;
use App\Http\Controllers\admin\components\WarnaController;
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

Route::get('/', function () {
    if (session('login') == true && session('role') == 'admin') {
        return redirect()->route('adminDashboard');
    }
    return view('welcome');
});


// admin
Route::get('admin', [AdminAuthController::class, 'index'])->middleware('authAdmin');
Route::post('loginAdmin', [AdminAuthController::class, 'login'])->name('loginAdmin')->middleware('authAdmin');
Route::get('adminDashboard', [AdminController::class, 'index'])->name('adminDashboard')->middleware('admin');
Route::get('warna', [WarnaController::class, 'index'])->name('warna')->middleware('admin');
Route::post('tambahWarna', [WarnaController::class, 'tambah'])->name('tambahWarna')->middleware('admin');
Route::post('updateWarna', [WarnaController::class, 'update'])->name('updateWarna')->middleware('admin');
Route::get('hapusWarna/{warnaId}', [WarnaController::class, 'hapus'])->name('hapusWarna')->middleware('admin');
