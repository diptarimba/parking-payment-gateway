<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParkingHistoryController;
use App\Http\Controllers\ParkingTransactionController;
use App\Http\Controllers\RegisterController;
use App\Models\ParkingTransaction;
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

Route::get('/auth/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/auth/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/auth/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/auth/register', [RegisterController::class, 'store'])->name('register.post');

Route::group(['middleware' => ['auth:web']], function(){

    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::get('/checkin', [ParkingTransactionController::class, 'checkin'])->name('checkin.index');
    Route::post('/checkin', [ParkingTransactionController::class, 'checkin_post'])->name('checkin.store');
    Route::get('/checkout', [ParkingTransactionController::class, 'checkout'])->name('checkout.index');
    Route::get('/history', [ParkingHistoryController::class, 'history'])->name('history.index');
    Route::get('/history/{code}/detail', [ParkingHistoryController::class, 'detail'])->name('history.detail');

    Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout.index');

});

// Route::get('/', [ParkingTransactionController::class, 'checkin'])->name('guest.checkin.index');
