<?php

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
    Route::get('/profile/{id}', [AuthClientController::class, 'getUserById']);
    Route::post('/credit/insertPengajuanKredit', [TransactionController::class, 'insertPengajuanKredit']);
    Route::post('/transaction/store', [TransactionController::class, 'insertTransaction']);
    Route::get('/bankaccount', [TransactionController::class, 'getAllBankAcc']);
    Route::post('/review/store', [ReviewController::class, 'store']);
    Route::get('/transaction/{userId}/{status}', [TransactionController::class, 'getHistoryTransaction']);
    Route::get('/transaction/{transactionId}', [TransactionController::class, 'detailTransaction']);
    Route::get('/invoice/download/{transactionId}', [InvoiceController::class, 'download']);
});
