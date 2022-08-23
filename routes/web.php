<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeadminController;
use App\Http\Controllers\Admin\BarangAdminController;
use App\Http\Controllers\Admin\KategoriAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\DataTransaksiController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\Admin\LoginAdminController;
use App\Http\Controllers\Admin\CobaRekapController;

use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\BeliLangsungController;
use App\Http\Controllers\TransaksiController;


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

//Sebelum
Route::get('/', [HomeController::class, 'index_frontend'])->name('index-frontend');
Route::get('detail-barang/{slug_barang}', [HomeController::class, 'detail_produk'])->name('detail-barang');
Route::get('produk-perkategori/{slug_kategori}', [HomeController::class, 'detail_perkategori'])->name('produk-perkategori');
Route::get('/cari-barang/{tnama}',[HomeController::class,'cari'])->name('cari');


Route::group(['middleware' => 'guest:member'], function () {
    //Register
    Route::get('register-member', [LoginController::class, 'register'])->name('register-member');
    Route::post('simpan-register', [LoginController::class, 'save_register'])->name('simpan-register');
    Route::get('/cities-register/{province_id}', [LoginController::class, 'getcities'])->name('getcities');
    //Login
    Route::get('login-member', [LoginController::class, 'loginmember'])->name('login-member');
    Route::post('aksi-login', [LoginController::class, 'aksi_login'])->name('aksi-login');
});

Route::group(['middleware' =>  ['web', 'auth:member']], function () {
    //Dashboard
    Route::get('index-frontend', [HomeController::class, 'index_frontend'])->name('index-frontends');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    ///Akun
    Route::get('view-akun', [AkunController::class, 'akun'])->name('view-akun');
    Route::post('edit-akun/{id}', [AkunController::class, 'editakun'])->name('edit-akun');
    Route::get('/cities-akun/{province_id}', [AkunController::class, 'getcities'])->name('cities-akun');
    //Keranjang
    Route::get('view-keranjang', [KeranjangController::class, 'viewkeranjang'])->name('view-keranjang');
    Route::post('simpan-keranjang', [KeranjangController::class, 'tambahkeranjang'])->name('simpan-keranjang');
    Route::get('hapus-keranjang/{id}', [KeranjangController::class, 'hapus'])->name('hapus-keranjang');
    Route::get('quantity-tambah/{id_keranjang}/{id_barang}', [KeranjangController::class, 'qtytambah'])->name('quantity-tambah');
    Route::get('quantity-kurang/{id_keranjang}/{id_barang}', [KeranjangController::class, 'qtykurang'])->name('quantity-kurang');
    //Bayar Langsung

    Route::get('view-belilangsung',[BeliLangsungController::class,'viewbelilangsung'])->name('view-belilangsung');
    Route::post('simpan-beli',[BeliLangsungController::class,'belilangsung'])->name('simpan-beli');
    Route::post('cek-ongkir/{id?}',[BeliLangsungController::class,'check_ongkir'])->name('cek-ongkir');
    Route::get('/pilih-kota/{province_id}',[BeliLangsungController::class,'getCities'])->name('pilih-kota');
    Route::post('send_result_midtrans_langsung',[TransaksiController::class, 'send_result_midtrans_langsung'])->name('send.result.midtrans.langsung');
    //Checkout barang
    Route::get('checkout-barang',[CheckoutController::class,'view_chechkout'])->name('checkout-barang');
    Route::post('cart/{id?}',[CheckoutController::class,'check_ongkir'])->name('cart');
    Route::get('/cities/{province_id}',[CheckoutController::class,'getCities'])->name('cities');
    Route::post('send_result_midtrans',[TransaksiController::class, 'send_result_midtrans'])->name('send.result.midtrans');
    //Riwayat Transaksi
    Route::get('view-riwayat-transaksi',[RiwayatTransaksiController::class,'view_riwayat_transaksi'])->name('view-riwayat-transaksi');
    Route::get('detail-riwayat-transaksi/{order_id}',[RiwayatTransaksiController::class,'detail_riwayat_transaksi'])->name('detail-riwayat-transaksi');
    Route::get('transaksi-selesai/{invoice}',[TransaksiController::class,'detail_transaksi'])->name('transaksi-selesai');

});


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [LoginAdminController::class, 'login'])->name('login-admin');
    Route::post('aksi-logint', [LoginAdminController::class, 'aksilogintAdmin'])->name('aksi-logint');
    Route::get('dashboard', [HomeadminController::class, 'indexAdmin'])->name('dashboard');
    //barang
    Route::get('view-barang', [BarangAdminController::class, 'indexbarang'])->name('view-barang');
    Route::get('tambah-barang', [BarangAdminController::class, 'tambahbarang'])->name('tambah-barang');
    Route::post('save-barang', [BarangAdminController::class, 'simpanbarang'])->name('save-barang');
    route::get('edit-barang/{id_barang}', [BarangAdminController::class, 'editbarang'])->name('edit-barang');
    Route::get('hapus-barang/{id_barang}', [BarangAdminController::class, 'hapusbarang'])->name('hapus-barang');
    Route::post('save-edit-barang', [BarangAdminController::class, 'save_editbarang'])->name('save-edit-barang');
    //kategori
    Route::get('view-kategori', [KategoriAdminController::class, 'viewkategori'])->name('view-kategori');
    Route::get('tambah-kategori', [KategoriAdminController::class, 'tambahkategori'])->name('tambah-kategori');
    Route::post('save-kategori', [KategoriAdminController::class, 'savekategori'])->name('save-kategori');
    Route::get('edit-kategori/{id_kategori}', [KategoriAdminController::class, 'editkategori'])->name('edit-kategori');
    Route::post('save-edit-kategori', [KategoriAdminController::class, 'save_editkategori'])->name('save-edit-kategori');
    Route::get('hapus-kategori/{id_kategori}', [KategoriAdminController::class, 'hapuskategori'])->name('hapus-kategori');
    //admin
    Route::get('view-admin', [AdminController::class, 'viewadmin'])->name('view-admin');
    Route::get('tambah-admin', [AdminController::class, 'tambahadmin'])->name('tambah-admin');
    Route::post('save-admin', [AdminController::class, 'saveadmin'])->name('save-admin');
    Route::get('edit-admin/{id_admin}', [AdminController::class, 'editadmin'])->name('edit-admin');
    Route::post('save-edit-admin', [AdminController::class, 'save_editadmin'])->name('save-edit-admin');
    Route::get('hapus-admin/{id_admin}', [AdminController::class, 'hapusadmin'])->name('hapus-admin');
    Route::get('profil-admin', [AdminController::class, 'profil'])->name('profil-admin');

    //transaksi
    Route::get('view-transaksi', [DataTransaksiController::class, 'index'])->name('transaksi');
    Route::post('input-nomor_resi', [DataTransaksiController::class, 'store_resi'])->name('transaksi.store_resi');
    Route::get('view-transaksi/delete/{id}', [DataTransaksiController::class, 'delete'])->name('transaksi.delete');

    //laporan
    Route::match(['get', 'post'], 'laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::post('laporan-cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::match(['get', 'post'], 'coba-laporan', [CobaRekapController::class, 'index'])->name('coba-laporan');

    Route::post('admin-logout', [LoginAdminController::class, 'logout'])->name('admin-logout');
});
