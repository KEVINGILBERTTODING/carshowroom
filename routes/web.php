<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\auth\AdminAuthController;
use App\Http\Controllers\admin\components\BahanBakarController;
use App\Http\Controllers\admin\components\KapasitasPenumpangController;
use App\Http\Controllers\admin\components\MerkController;
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
Route::get('admin', [AdminAuthController::class, 'index'])->name('admin')->middleware('authAdmin');
Route::post('loginAdmin', [AdminAuthController::class, 'login'])->name('loginAdmin')->middleware('authAdmin');
Route::get('adminDashboard', [AdminController::class, 'index'])->name('adminDashboard')->middleware('admin');
Route::get('logOutAdmin', [AdminAuthController::class, 'logOutAdmin'])->name('logOutAdmin');

// warna mobil
Route::get('warna', [WarnaController::class, 'index'])->name('warna')->middleware('admin');
Route::post('tambahWarna', [WarnaController::class, 'tambah'])->name('tambahWarna')->middleware('admin');
Route::post('updateWarna', [WarnaController::class, 'update'])->name('updateWarna')->middleware('admin');
Route::get('hapusWarna/{warnaId}', [WarnaController::class, 'hapus'])->name('hapusWarna')->middleware('admin');

// merk mobil

Route::get('merk', [MerkController::class, 'index'])->name('merk')->middleware('admin');
Route::post('tambahMerk', [MerkController::class, 'tambah'])->name('tambahMerk')->middleware('admin');
Route::post('updateMerk', [MerkController::class, 'update'])->name('updateMerk')->middleware('admin');
Route::get('hapusMerk/{merkId}', [MerkController::class, 'hapus'])->name('hapusMerk')->middleware('admin');


// kapasitas penumpang

Route::get('kapasitasPenumpang', [KapasitasPenumpangController::class, 'index'])->name('kapasitasPenumpang')->middleware('admin');
Route::post('tambahKapasitasPenumpang', [KapasitasPenumpangController::class, 'tambah'])->name('tambahKapasitasPenumpang')->middleware('admin');
Route::post('updateKapasitasPenumpang', [KapasitasPenumpangController::class, 'update'])->name('updateKapasitasPenumpang')->middleware('admin');
Route::get('hapusKapasitasPenumpang/{kpId}', [KapasitasPenumpangController::class, 'hapus'])->name('hapusKapasitasPenumpang')->middleware('admin');


// kapasitas penumpang

Route::get('bahanBakar', [BahanBakarController::class, 'index'])->name('bahanBakar')->middleware('admin');
Route::post('tambahBahanBakar', [BahanBakarController::class, 'tambah'])->name('tambahBahanBakar')->middleware('admin');
Route::post('updateBahanBakar', [BahanBakarController::class, 'update'])->name('updateBahanBakar')->middleware('admin');
Route::get('hapusBahanBakar/{bahanBakarId}', [BahanBakarController::class, 'hapus'])->name('hapusBahanBakar')->middleware('admin');
