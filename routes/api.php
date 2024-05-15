<?php

use App\Http\Controllers\admin\transactions\TransactionController as TransactionsTransactionController;
use App\Http\Controllers\api\admin\AdminController;
use App\Http\Controllers\api\admin\MobilController as AdminMobilController;
use App\Http\Controllers\api\admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\api\auth\AuthClientController;
use App\Http\Controllers\api\client\AppController;
use App\Http\Controllers\api\client\CreditController;
use App\Http\Controllers\api\client\FinanceController;
use App\Http\Controllers\api\client\MobilController;
use App\Http\Controllers\api\client\ReviewController;
use App\Http\Controllers\api\client\TransactionController;
use App\Http\Controllers\client\invoice\InvoiceController;
use App\Http\Controllers\client\main\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthClientController::class, 'login']);
    Route::post('/register', [AuthClientController::class, 'register']);
});

Route::prefix('client')->group(function () {
    Route::get('/main', [AppController::class, 'index']);
    Route::get('/car', [MobilController::class, 'tampilMobil']);
    Route::get('/car/{id}', [MobilController::class, 'detailMobilCLient']);
    Route::get('/search', [MobilController::class, 'cariMobil']);
    Route::get('datafilter', [MobilController::class, 'getDataFilter']);
    Route::get('filter', [MobilController::class, 'filterMobil']);
    Route::get('/finance', [FinanceController::class, 'getAllFinance']);
    Route::get('/finance/{id}', [FinanceController::class, 'detailFinance']);
    Route::get('/credit/{mobilId}/{financeId}', [CreditController::class, 'credit']);
    Route::post('/countcredit', [CreditController::class, 'countCredit']);
    Route::post('/profile/updatephoto', [AuthClientController::class, 'updateProfilePhoto']);
    Route::post('/profile/update', [AuthClientController::class, 'updateProfile']);
    Route::post('/profile/update/password', [AuthClientController::class, 'updatePassword']);
    Route::get('/profile/{id}/{role}', [AuthClientController::class, 'getUserById']);
    Route::post('/credit/insertPengajuanKredit', [TransactionController::class, 'insertPengajuanKredit']);
    Route::post('/transaction/store', [TransactionController::class, 'insertTransaction']);
    Route::get('/bankaccount', [TransactionController::class, 'getAllBankAcc']);
    Route::post('/review/store', [ReviewController::class, 'store']);
    Route::get('/transaction/{userId}/{status}', [TransactionController::class, 'getHistoryTransaction']);
    Route::get('/transaction/{transactionId}', [TransactionController::class, 'detailTransaction']);
    Route::get('/invoice/download/{transactionId}', [InvoiceController::class, 'download']);
});

Route::get('downloadfile/{type}/{filename}', [AdminTransactionController::class, 'downloadFile']);

Route::prefix('admin/')->group(function () {
    Route::get('main', [AdminController::class, 'index']);
    Route::get('profit/filter/{month}', [AdminController::class, 'filterProfitIncome']);
    Route::get('transaction/profit/download', [AdminTransactionController::class, 'downloadReportProfit']);
    Route::get('transaction/all/{status}', [AdminTransactionController::class, 'allTransactions']);
    Route::get('car/getDataCarComponents', [AdminMobilController::class, 'getDataTambahMobil']);
    Route::post('car/store', [AdminMobilController::class, 'insertMobil']);
    Route::delete('car/destroy/{id}', [AdminMobilController::class, 'hapus']);
    Route::get('car/{id}', [AdminMobilController::class, 'adminDetailMobil']);
    Route::get('car/report/{id}', [AdminMobilController::class, 'downloadReportCars']);
    Route::post('car/update/{id}', [AdminMobilController::class, 'updateMobil']);
    Route::delete('transaction/destroy/{id}/{payment}', [AdminTransactionController::class, 'hapusTrasaksi']);
    Route::post('transaction/update/{transId}', [AdminTransactionController::class, 'updateStatusTransaksi']);
    Route::get('transaction/filter', [AdminTransactionController::class, 'filterTransaksi']);
    Route::get('transaction/filter/download', [AdminTransactionController::class, 'downloadReportPdf']);
});
