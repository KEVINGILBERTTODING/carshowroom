<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\auth\AdminAuthController;
use App\Http\Controllers\admin\components\BahanBakarController;
use App\Http\Controllers\admin\components\BodyController;
use App\Http\Controllers\admin\components\KapasitasMesinController;
use App\Http\Controllers\admin\components\KapasitasPenumpangController;
use App\Http\Controllers\admin\components\MerkController;
use App\Http\Controllers\admin\components\TangkiController;
use App\Http\Controllers\admin\components\TransmisiController;
use App\Http\Controllers\admin\components\WarnaController;
use App\Http\Controllers\admin\MobilController;
use App\Http\Controllers\admin\transactions\TransactionController;
use App\Http\Controllers\FinanceController;
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


// bahan bakar

Route::get('bahanBakar', [BahanBakarController::class, 'index'])->name('bahanBakar')->middleware('admin');
Route::post('tambahBahanBakar', [BahanBakarController::class, 'tambah'])->name('tambahBahanBakar')->middleware('admin');
Route::post('updateBahanBakar', [BahanBakarController::class, 'update'])->name('updateBahanBakar')->middleware('admin');
Route::get('hapusBahanBakar/{bahanBakarId}', [BahanBakarController::class, 'hapus'])->name('hapusBahanBakar')->middleware('admin');



// Transmisi

Route::get('transmisi', [TransmisiController::class, 'index'])->name('transmisi')->middleware('admin');
Route::post('tambahTransmisi', [TransmisiController::class, 'tambah'])->name('tambahTransmisi')->middleware('admin');
Route::post('updateTransmisi', [TransmisiController::class, 'update'])->name('updateTransmisi')->middleware('admin');
Route::get('hapusTransmisi/{transmisiId}', [TransmisiController::class, 'hapus'])->name('hapusTransmisi')->middleware('admin');


// Body

Route::get('body', [BodyController::class, 'index'])->name('body')->middleware('admin');
Route::post('tambahBody', [BodyController::class, 'tambah'])->name('tambahBody')->middleware('admin');
Route::post('updateBody', [BodyController::class, 'update'])->name('updateBody')->middleware('admin');
Route::get('hapusBody/{bodyId}', [BodyController::class, 'hapus'])->name('hapusBody')->middleware('admin');


// Kapasitas tangki

Route::get('tangki', [TangkiController::class, 'index'])->name('tangki')->middleware('admin');
Route::post('tambahTangki', [TangkiController::class, 'tambah'])->name('tambahTangki')->middleware('admin');
Route::post('updateTangki', [TangkiController::class, 'update'])->name('updateTangki')->middleware('admin');
Route::get('hapusTangki/{tangkiId}', [TangkiController::class, 'hapus'])->name('hapusTangki')->middleware('admin');



// kapasitas mesin

Route::get('kapasitasMesin', [KapasitasMesinController::class, 'index'])->name('kapasitasMesin')->middleware('admin');
Route::post('tambahKapasitasMesin', [KapasitasMesinController::class, 'tambah'])->name('tambahKapasitasMesin')->middleware('admin');
Route::post('updateKapasitasMesin', [KapasitasMesinController::class, 'update'])->name('updateKapasitasMesin')->middleware('admin');
Route::get('hapusKapasitasMesin/{kmId}', [KapasitasMesinController::class, 'hapus'])->name('hapusKapasitasMesin')->middleware('admin');

// Finance
Route::get('finance', [FinanceController::class, 'index'])->name('finance')->middleware('admin');
Route::post('tambahFinance', [FinanceController::class, 'tambah'])->name('tambahFinance')->middleware('admin');
Route::post('ubahFinance', [FinanceController::class, 'ubah'])->name('ubahFinance')->middleware('admin');
Route::get('hapusFinance/{financeId}', [FinanceController::class, 'hapus'])->name('hapusFinance')->middleware('admin');

// profile admin
Route::get('adminProfile', [AdminController::class, 'profil'])->name('adminProfile')->middleware('admin');
Route::post('ubahFotoProfilAdmin', [AdminController::class, 'ubahFotoProfil'])->name('ubahFotoProfilAdmin')->middleware('admin');
Route::post('ubahProfilAdmin', [AdminController::class, 'ubahProfile'])->name('ubahProfilAdmin')->middleware('admin');

// mobil
Route::get('tambahMobilBaru', [MobilController::class, 'tambahMobil'])->name('tambahMobilBaru')->middleware('admin');
Route::post('insertMobil', [MobilController::class, 'insertMobil'])->name('insertMobil')->middleware('admin');
Route::get('seluruhMobil', [MobilController::class, 'seluruhMobil'])->name('seluruhMobil')->middleware('admin');
Route::get('mobilDiPesan', [MobilController::class, 'mobilDiPesan'])->name('mobilDiPesan')->middleware('admin');
Route::get('mobilTersedia', [MobilController::class, 'mobilTersedia'])->name('mobilTersedia')->middleware('admin');
Route::get('MobilTerjual', [MobilController::class, 'MobilTerjual'])->name('MobilTerjual')->middleware('admin');
Route::get('hapusMobil/{mobilId}', [MobilController::class, 'hapus'])->name('hapusMobil')->middleware('admin');
Route::get('ubahMobil/{mobilId}', [MobilController::class, 'ubahMobil'])->name('ubahMobil')->middleware('admin');
Route::post('updateMobil', [MobilController::class, 'updateMobil'])->name('updateMobil')->middleware('admin');
Route::post('setStatusMobilTersedia', [MobilController::class, 'setStatusMobilTersedia'])->name('setStatusMobilTersedia')->middleware('admin');
Route::post('setStatusMobilTerjual', [MobilController::class, 'setStatusMobilTerjual'])->name('setStatusMobilTerjual')->middleware('admin');
Route::get('ajaxGetDetailMobil/{mobilId}', [MobilController::class, 'ajaxGetDetailMobil'])->name('ajaxGetDetailMobil');




// pengguna
Route::get('dataPemilik', [AdminController::class, 'owner'])->name('dataPemilik')->middleware('admin');
Route::post('tambahPemilik', [AdminController::class, 'tambahPemilik'])->name('tambahPemilik')->middleware('admin');
Route::post('updatePemilik', [AdminController::class, 'updatePemilik'])->name('updatePemilik')->middleware('admin');
Route::get('hapusPemilik/{ownerId}', [AdminController::class, 'hapusPemilik'])->name('hapusPemilik')->middleware('admin');
Route::get('adminDetailMobil/{mobilId}', [MobilController::class, 'adminDetailMobil'])->name('adminDetailMobil')->middleware('admin');

// admin transactions
Route::get('allDataTransactions', [TransactionController::class, 'allTransactions'])->name('allDataTransactions')->middleware('admin');
Route::get('allTransactionSuccess', [TransactionController::class, 'allTransactionSuccess'])->name('allTransactionSuccess')->middleware('admin');
Route::get('allTransactionProcess', [TransactionController::class, 'allTransactionProcess'])->name('allTransactionProcess')->middleware('admin');
Route::get('allTransactionProcessFinance', [TransactionController::class, 'allTransactionProcessFinance'])->name('allTransactionProcessFinance')->middleware('admin');
Route::get('allTransactionFailed', [TransactionController::class, 'allTransactionFailed'])->name('allTransactionFailed')->middleware('admin');
Route::post('adminTambahTransaksi', [TransactionController::class, 'tambahTransaksi'])->name('adminTambahTransaksi')->middleware('admin');
Route::get('adminDetailTransaction/{transaksiId}', [TransactionController::class, 'detailTransaction'])->name('adminDetailTransaction')->middleware('admin');
Route::get('downloadFileCredit/{fileName}', [TransactionController::class, 'downloadFileCredit'])->name('downloadFileCredit')->middleware('admin');
Route::get('downloadBuktiPembayaran/{fileName}', [TransactionController::class, 'downloadBuktiPembayaran'])->name('downloadBuktiPembayaran')->middleware('admin');
Route::post('updateStatusTransaksi', [TransactionController::class, 'updateStatusTransaksi'])->name('updateStatusTransaksi')->middleware('admin');
Route::get('adminHapusTrasaksi/{transaksiId}', [TransactionController::class, 'hapusTrasaksi'])->name('adminHapusTrasaksi')->middleware('admin');
Route::get('filterTransaksi', [TransactionController::class, 'filterTransaksi'])->name('filterTransaksi')->middleware('admin');
