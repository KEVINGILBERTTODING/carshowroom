<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\auth\AdminAuthController;
use App\Http\Controllers\admin\LoginController;
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
    return view('welcome');
});

Route::get('admin', [AdminAuthController::class, 'index']);
Route::post('loginAdmin', [AdminAuthController::class, 'login'])->name('loginAdmin');
Route::get('adminDashboard', [AdminController::class, 'index'])->name('adminDashboard')->middleware('admin');
