<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\SAController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CekOngkirController;

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

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);


Route::get('/ongkir', [CekOngkirController::class, 'index']);
 
Route::group(['middleware' => 'auth'], function () {
    Route::post('gantipassword',[AuthController::class, 'gpass'])->name('gantipassword');
    Route::get('password', [AuthController::class, 'gp'])->name('password');
    Route::get('home', [AuthController::class, 'index'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    

    Route::group(['middleware' => 'super'], function () {
        Route::get('dataadmin', [SAController::class, 'dataadmin'])->name('dataadmin');
        Route::get('tambahadmin', [SAController::class, 'showtambahadmin'])->name('tambahadmin');
        Route::post('tambahadmin', [SAController::class, 'tambahadmin']);
        Route::get('dataalumni', [SAController::class, 'dataalumni'])->name('dataalumni');
        Route::post('/hapusakun/{id}', [SAController::class, 'hapusakun'])->name('hapusakun');
        Route::get('dataprodi', [SAController::class, 'showdataprogdi'])->name('dataprodi');
        Route::post('dataprodi', [SAController::class, 'dataprogdi']);
        Route::post('/hapusprodi/{id}', [SAController::class, 'hapusprodi'])->name('hapusprodi');
    });

    Route::group(['middleware' => 'usr'], function () {
        Route::get('profil', [UserController::class, 'showprofil'])->name('profil');
        Route::post('profil', [UserController::class, 'profil']);
        Route::post('inputtracerstudy', [UserController::class, 'inputtracer'])->name('inputtracerstudy');
        Route::get('/tracer',[UserController::class, 'tc']);
        Route::post('editprofil',[UserController::class, 'epf'])->name('editprofil');
        Route::group(['middleware' => 'prf'], function () {
            Route::get('daftarberkas', [UserController::class, 'showdaftarberkas'])->name('daftarberkas');
            Route::post('daftarberkas', [UserController::class, 'daftarberkas']);
            Route::post('/hapusberkas/{id}', [UserController::class, 'hapusberkas'])->name('hapusberkas');
            Route::post('editberkas', [UserController::class, 'editberkas'])->name('editberkas');
            Route::group(['middleware' =>'tc'], function() {
                Route::get('permintaan', [UserController::class, 'showpermintaanlegalisir'])->name('permintaanlegalisir');
                Route::post('pesan', [UserController::class, 'permintaanlegalisir'])->name('pesan');
                Route::post('ongkir', [CekOngkirController::class, 'check_ongkir'])->name('ongkir');
                Route::get('/cities/{province_id}', [CekOngkirController::class, 'getCities']);
                Route::post('kirim', [UserController::class, 'kiriman'])->name('kirim');
                Route::post('expi', [UserController::class, 'endpesan'])->name('expi');
                Route::post('/hapuspemesanan/{id}', [UserController::class, 'hapuspemesanan'])->name('hapuspemesanan');
                Route::get('pemesanan', [UserController::class, 'pemesanan'])->name('pemesanan');
                Route::post('/batalpemesanan/{id}', [UserController::class, 'batalpesan'])->name('batalpemesanan');
                Route::post('buktibayar', [UserController::class, 'buktibayar'])->name('buktibayar');
                Route::post('selesai', [UserController::class, 'done'])->name('selesai');
            });
        });
    });

    Route::group(['middleware' => 'adm'], function (){
        Route::get('validasi', [AdmController::class, 'showvalidberkas'])->name('validasiberkas');
        Route::post('validberkas', [AdmController::class, 'validberkas'])->name('validberkas');
        Route::post('validtracer', [AdmController::class, 'validtracer'])->name('validtracer');
        Route::get('permintaanlegalisir', [AdmController::class, 'pl'])->name('permintaan');
        Route::get('/konfirmasi/{id}', [AdmController::class, 'kk'])->name('konfirmasi');
        Route::get('/prosesambil/{id}', [AdmController::class, 'prosesambil'])->name('prosesambil');
        Route::post('proseskirim', [AdmController::class, 'proseskirim'])->name('proseskirim');
        Route::post('selesaiadm', [AdmController::class, 'done'])->name('selesaiadm');
    });
});
