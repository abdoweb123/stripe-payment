<?php

use App\Http\Controllers\StripeController;
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
    return view('welcome');
//    return 'ds';
});



Route::get('/checkout', [StripeController::class,'checkout'])->name('checkout');
Route::post('/session', [StripeController::class,'session'])->name('session');
Route::get('/success', [StripeController::class,'success'])->name('success');
