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
use App\Http\Controllers\admin\users\UsersController;
use App\Http\Controllers\client\auth\AuthClientController;
use App\Http\Controllers\client\main\MainController;
use App\Http\Controllers\client\transaction\TransactionController as TransactionTransactionController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\ClientMiddleware;
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

// main route
Route::get('/', [MainController::class, 'index'])->name('/');


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
Route::get('downloadReportCars/{status}', [MobilController::class, 'downloadReportCars'])->name('downloadReportCars')->middleware('admin');





// pengguna
Route::get('dataPemilik', [UsersController::class, 'owner'])->name('dataPemilik')->middleware('admin');
Route::post('tambahPemilik', [UsersController::class, 'tambahPemilik'])->name('tambahPemilik')->middleware('admin');
Route::post('updatePemilik', [UsersController::class, 'updatePemilik'])->name('updatePemilik')->middleware('admin');
Route::get('hapusPemilik/{ownerId}', [UsersController::class, 'hapusPelanggan'])->name('hapusPemilik')->middleware('admin');
Route::get('hapusPelanggan/{pelangganId}', [UsersController::class, 'hapusPelanggan'])->name('hapusPelanggan')->middleware('admin');
Route::get('dataPelanggan', [UsersController::class, 'pelanggan'])->name('dataPelanggan')->middleware('admin');
Route::post('updatePelanggan', [UsersController::class, 'updatePelanggan'])->name('updatePelanggan')->middleware('admin');
Route::get('dataPengguna', [UsersController::class, 'pengguna'])->name('dataPengguna')->middleware('admin');
Route::post('updatePengguna', [UsersController::class, 'updatePengguna'])->name('updatePengguna')->middleware('admin');
Route::get('dataKaryawan', [UsersController::class, 'karyawan'])->name('dataKaryawan')->middleware('admin');
Route::post('tambahKaryawan', [UsersController::class, 'tambahKaryawan'])->name('tambahKaryawan')->middleware('admin');
Route::post('updateKaryawan', [UsersController::class, 'updateKaryawan'])->name('updateKaryawan')->middleware('admin');
Route::get('hapusKaryawan/{karyawanId}', [UsersController::class, 'hapusKaryawan'])->name('hapusKaryawan')->middleware('admin');





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
Route::get('adminHapusTrasaksi/{transaksiId}/{paymentMethod}', [TransactionController::class, 'hapusTrasaksi'])->name('adminHapusTrasaksi')->middleware('admin');
Route::get('filterTransaksi', [TransactionController::class, 'filterTransaksi'])->name('filterTransaksi')->middleware('admin');
Route::get('downloadReportPdf', [TransactionController::class, 'downloadReportPdf'])->name('downloadReportPdf')->middleware('admin');
Route::get('downloadReportSuccessPdf', [TransactionController::class, 'downloadReportSuccessPdf'])->name('downloadReportSuccessPdf')->middleware('admin');
Route::get('getDetailTransaksiUser/{userId}/{namaLengkap}', [TransactionController::class, 'getDetailTransaksiUser'])->name('getDetailTransaksiUser')->middleware('admin');
Route::get('getDetailTransaksiPelanggan{pelangganId}/{namaLengkap}', [TransactionController::class, 'getDetailTransaksiPelanggan'])->name('getDetailTransaksiPelanggan')->middleware('admin');
Route::get('totalProfitPerTahun', [TransactionController::class, 'totalProfitPerTahun'])->name('totalProfitPerTahun')->middleware('admin');
Route::get('total', [TransactionController::class, 'total'])->name('total')->middleware('admin');
Route::get('downloadReportTransactionMonth', [TransactionController::class, 'downloadReportTransactionMonth'])->name('downloadReportTransactionMonth')->middleware('admin');
Route::get('downloadReportProfit', [TransactionController::class, 'downloadReportProfit'])->name('downloadReportProfit')->middleware('admin');


// landing page
Route::get('dataFinance', [MainController::class, 'finance'])->name('dataFinance');
Route::get('detailDataFinance/{financeId}', [MainController::class, 'detailFinance'])->name('detailDataFinance');
Route::get('aboutUs', [MainController::class, 'aboutUs'])->name('aboutUs');
Route::get('review', [MainController::class, 'review'])->name('review');

// mobil
Route::get('mobil', [MobilController::class, 'tampilMobil'])->name('mobil');
Route::get('detailMobil/{mobilId}', [MobilController::class, 'detailMobilClient'])->name('detailMobil');

// credit
Route::get('credit/{mobilId}/{financeId}', [CreditController::class, 'credit'])->name('credit');
Route::post('countCredit', [CreditController::class, 'countCredit'])->name('countCredit');

// user guide
Route::get('userGuide', [MainController::class, 'userGuide'])->name('userGuide');

// transaction
Route::get('createNewTransaction/{mobilId}', [TransactionTransactionController::class, 'createNewTransaction'])->name('createNewTransaction');
Route::post('insertTransaction', [TransactionTransactionController::class, 'insertTransaction'])->name('insertTransaction')->middleware('authClient');
Route::get('pengajuanKredit/{mobilId}/{financeId}', [TransactionTransactionController::class, 'pengajuanKredit'])->name('pengajuanKredit');
Route::post('insertPengajuanKredit', [TransactionTransactionController::class, 'insertPengajuanKredit'])->name('insertPengajuanKredit')->middleware('authClient');




// client auth
Route::post('loginWithGoogle', [AuthClientController::class, 'loginWithGoogle'])->name('loginWithGoogle');
Route::post('register', [AuthClientController::class, 'register'])->name('register');
Route::post('login', [AuthClientController::class, 'login'])->name('login');
Route::post('updatePassword', [AuthClientController::class, 'updatePassword'])->name('updatePassword')->middleware('authClient');
Route::post('updateProfile', [AuthClientController::class, 'updateProfile'])->name('updateProfile')->middleware('authClient');

// bank account
Route::get('getBankAccountById/{bankId}', [TransactionTransactionController::class, 'getBankAccountById'])->name('getBankAccountById');


// client dashboard
Route::get('dashboardClient', [MainController::class, 'dashboardClient'])->name('dashboardClient')->middleware('authClient');
Route::get('logOut', [MainController::class, 'logOut'])->name('logOut')->middleware('authClient');
Route::get('transaksiSelesai', [TransactionTransactionController::class, 'getTransactionSuccess'])->name('transaksiSelesai')->middleware('authClient');
Route::get('transaksiProses', [TransactionTransactionController::class, 'getTransactionProcess'])->name('transaksiProses')->middleware('authClient');
Route::get('transaksiProsesFinance', [TransactionTransactionController::class, 'getTransactionProcessFinance'])->name('transaksiProsesFinance')->middleware('authClient');
Route::get('transaksiTidakValid', [TransactionTransactionController::class, 'getTransactionFailed'])->name('transaksiTidakValid')->middleware('authClient');

// transaksi client
Route::get('detailTransaksi/{transactionId}', [TransactionTransactionController::class, 'detailTransaction'])->name('detailTransaksi')->middleware('authClient');
Route::get('downloadFileCreditClient/{fileName}', [TransactionTransactionController::class, 'downloadFileCredit'])->name('downloadFileCreditClient')->middleware('authClient');
Route::get('downloadBuktiPembayaranClient/{fileName}', [TransactionTransactionController::class, 'downloadBuktiPembayaran'])->name('downloadBuktiPembayaranClient')->middleware('authClient');

// review Client
Route::post('storeReview', [ReviewController::class, 'store'])->name('storeReview')->middleware('authClient');

// profile client
Route::get('profile', [MainController::class, 'profile'])->name('profile')->middleware('authClient');
