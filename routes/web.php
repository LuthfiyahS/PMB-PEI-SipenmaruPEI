<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SipenmaruController;

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
});
Route::get('/login', [SipenmaruController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [SipenmaruController::class, 'proslogin']);
Route::get('/logout', [SipenmaruController::class, 'logout']);

Route::get('/signup', [SipenmaruController::class, 'register'])->name('register')->middleware('guest');
Route::post('/signup', [SipenmaruController::class, 'insertRegis']);

//Route::get('/master', [SipenmaruController::class, 'master']);
Route::get('/index', [SipenmaruController::class, 'dashboard']);

Route::get('/profile', [SipenmaruController::class, 'dataprofil']);
Route::post('/edit-profile', [SipenmaruController::class, 'editprofil']);
Route::post('/edit-pw/{id}', [SipenmaruController::class, 'editakun']);

Route::get('/data-user', [SipenmaruController::class, 'datauser']);
Route::post('/save-user', [SipenmaruController::class, 'simpanuser']);
Route::get('/edit-user/{id_user}', [SipenmaruController::class, 'edituser']);
Route::post('/update-user/{id_user}', [SipenmaruController::class, 'updateuser']);
Route::get('/delete-user/{id_user}', [SipenmaruController::class, 'hapususer']);

Route::get('/data-school', [SipenmaruController::class, 'datasekolah']);
Route::post('/save-school', [SipenmaruController::class, 'simpansekolah']);
Route::post('/update-school/{NPSN}', [SipenmaruController::class, 'updatesekolah']);
Route::get('/delete-school/{NPSN}', [SipenmaruController::class, 'hapussekolah']);

Route::get('/data-jadwal', [SipenmaruController::class, 'datajadwal']);
Route::post('/save-jadwal', [SipenmaruController::class, 'simpanjadwal']);
Route::post('/update-jadwal/{id}', [SipenmaruController::class, 'updatejadwal']);
Route::get('/delete-jadwal/{id}', [SipenmaruController::class, 'hapusjadwal']);


Route::get('/data-studyProgram', [SipenmaruController::class, 'dataprodi']);
Route::post('/save-studyProgram', [SipenmaruController::class, 'simpanprodi']);
Route::post('/update-studyProgram/{id_prodi}', [SipenmaruController::class, 'updateprodi']);
Route::get('/delete-studyProgram/{id_prodi}', [SipenmaruController::class, 'hapusprodi']);

Route::get('/data-registration', [SipenmaruController::class, 'datapendaftaran']);
Route::get('/form-registration', [SipenmaruController::class, 'inputpendaftaran']);
Route::post('/save-registration', [SipenmaruController::class, 'simpanpendaftaran']);
Route::get('/edit-registration/{id_pendaftaran}', [SipenmaruController::class, 'editpendaftaran']);
Route::post('/update-registration/{id_pendaftaran}', [SipenmaruController::class, 'updatependaftaran']);
Route::get('/delete-registration/{id_pendaftaran}', [SipenmaruController::class, 'hapuspendaftaran']);
Route::get('/detail-registration/{id_pendaftaran}', [SipenmaruController::class, 'detailpendaftaran']);
Route::get('/card-registration/{id_pendaftaran}', [SipenmaruController::class, 'kartupendaftaran']);

Route::get('/verified-registration/{id_pendaftaran}', [SipenmaruController::class, 'verifikasistatuspendaftaran']);
Route::get('/notverified-registration/{id_pendaftaran}', [SipenmaruController::class, 'notverifikasistatuspendaftaran']);
Route::get('/invalid-registration/{id_pendaftaran}', [SipenmaruController::class, 'invalidstatuspendaftaran']);

Route::get('/data-payment', [SipenmaruController::class, 'datapembayaran']);
Route::post('/save-payment', [SipenmaruController::class, 'simpanpembayaran']);
Route::post('/update-payment/{id_pembayaran}', [SipenmaruController::class, 'updatepembayaran']);
Route::get('/delete-payment/{id_pembayaran}', [SipenmaruController::class, 'hapuspembayaran']);

Route::post('/upload-payment', [SipenmaruController::class, 'updatebuktipembayaran']);
Route::get('/paid-payment/{id_pembayaran}', [SipenmaruController::class, 'verifikasipembayaran']);
Route::get('/unpaid-payment/{id_pembayaran}', [SipenmaruController::class, 'belumbayar']);
Route::get('/invalid-payment/{id_pembayaran}', [SipenmaruController::class, 'invalidbayar']);

Route::get('/data-announcement', [SipenmaruController::class, 'datapengumuman']);
Route::get('/view-announcement/{id_pendaftaran}', [SipenmaruController::class, 'lihatpengumuman']);
//Route::get('/view-announcement', [SipenmaruController::class, 'lihatpengumuman']);
Route::post('/save-announcement', [SipenmaruController::class, 'simpanpengumuman']);
Route::post('/update-announcement/{id_pengumuman}', [SipenmaruController::class, 'updatepengumuman']);
Route::get('/delete-announcement/{id_pengumuman}', [SipenmaruController::class, 'hapuspengumuman']);