<?php

use App\Http\Controllers\admin\AdminController;
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

// Route::get('/admin', function () {
//     return ro
// });

Route::get('/admin', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'login'])->name('login');


Route::get('dashboard_admin', [AdminController::class, 'index'])->name('dashboard_admin');
