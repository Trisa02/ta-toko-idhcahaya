<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\api\PaymentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('get-snaptoken', [TransaksiController::class, 'get_snap_token'])->name('get.snaptoken');

//snap token untuk checkout langsung
Route::post('get-snaptoken-langsung', [TransaksiController::class, 'get_snap_token_langsung'])->name('get.snaptoken.langsung');

Route::post('payment-handler', [PaymentController::class, 'payment_handler'])->name('payment.handler');
Route::post('payment-handler-keranjang',[PaymentController::class, 'payment_handler_keranjang'])->name('payment.handler.keranjang');

//Lacak barang
Route::post('lacak-barang',[RiwayatTransaksiController::class,'lacak'])->name('lacak-barang');

