<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramControllerFix;
use App\Http\Controllers\JenisKelasController;
use App\Http\Controllers\petugasController;
use App\Http\Controllers\ruanganController;
use App\Http\Controllers\pengajarController;
use App\Http\Controllers\landingController;
use App\Http\Controllers\orangtuaController;
use App\Http\Controllers\pendaftaranController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\jadwalController;
use App\Http\Controllers\absensiController;
use App\Http\Controllers\absensiDetailController;
use GuzzleHttp\Middleware;

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


Route::get('testtable', function () {

    return view('dashboard.pendaftaran.testing-tabletable');
});




Route::get('login', [AuthController::class, 'login_index'])->name('login');
Route::get('register', [AuthController::class, 'register_index'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login-proses');
Route::post('register', [AuthController::class, 'register'])->name('register.proses');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');




Route::get('/', [landingController::class, 'index'])->name('landingpage');
Route::get('detailprogram/', [landingController::class, 'detailprogram'])->name('user-detailprogram');

// group with middleware
Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'role:admin'], function () {
        Route::get('dashboard-admin', [dashboardController::class, 'index'])->name('dashboard');

        // PROGRAM
        Route::group(['prefix' => 'program'], function () {
            Route::get('/', [ProgramControllerFix::class, 'index'])->name('program.index');
            Route::get('/{id}/show', [ProgramControllerFix::class, 'show'])->name('program.show');
            Route::get('/create', [ProgramControllerFix::class, 'create'])->name('program.create');
            Route::post('/store', [ProgramControllerFix::class, 'store'])->name('program.store');
            Route::get('/{id}', [ProgramControllerFix::class, 'edit'])->name('program.edit');
            Route::post('/{id}/update', [ProgramControllerFix::class, 'update'])->name('program.update');
            Route::delete('/{id}/destroy', [ProgramControllerFix::class, 'destroy'])->name('program.destroy');
            Route::get('/{id}/getkategori', [ProgramControllerFix::class, 'getkategori'])->name('program.getkategori');
        });
        // JENIS KELAS
        Route::group(['prefix' => 'jeniskelas'], function () {
            Route::get('/', [JenisKelasController::class, 'index'])->name('jeniskelas.index');
            Route::get('/{id}', [JenisKelasController::class, 'show'])->name('jeniskelas.show');
            Route::post('/store', [JenisKelasController::class, 'store'])->name('jeniskelas.store');
            Route::post('/{id}/update', [JenisKelasController::class, 'update'])->name('jeniskelas.update');
            Route::delete('/{id}/destroy', [JenisKelasController::class, 'destroy'])->name('jeniskelas.destroy');
        });
        // PETUGAS
        Route::group(['prefix' => 'petugas'], function () {
            Route::get('/', [petugasController::class, 'index'])->name('petugas.index');
            Route::get('/{nohp}/wa', [petugasController::class, 'wa'])->name('petugas.wa');
            Route::get('/create', [petugasController::class, 'create'])->name('petugas.create');
            Route::get('/{id}', [petugasController::class, 'show'])->name('petugas.show');
            Route::post('/store', [petugasController::class, 'store'])->name('petugas.store');
            Route::get('/{id}/edit', [petugasController::class, 'edit'])->name('petugas.edit');
            Route::post('/{id}/update', [petugasController::class, 'update'])->name('petugas.update');
            Route::delete('/{id}/destroy', [petugasController::class, 'destroy'])->name('petugas.destroy');
        });
        // RUANGAN
        Route::group(['prefix' => 'ruangan'], function () {
            Route::get('/', [ruanganController::class, 'index'])->name('ruangan.index');
            Route::get('/create', [ruanganController::class, 'create'])->name('ruangan.create');
            Route::post('/store', [ruanganController::class, 'store'])->name('ruangan.store');
            Route::get('/{id}', [ruanganController::class, 'edit'])->name('ruangan.edit');
            Route::post('/{id}/update', [ruanganController::class, 'update'])->name('ruangan.update');
            Route::delete('/{id}/destroy', [ruanganController::class, 'destroy'])->name('ruangan.destroy');
            Route::get('/{nohp}/wa', [ruanganController::class, 'wa'])->name('ruangan.wa');
        });
        // PENGAJAR

        Route::group(['prefix' => 'pengajar'], function () {
            Route::get('/{nohp}/wa', [pengajarController::class, 'wa'])->name('pengajar.wa');
            Route::get('/', [pengajarController::class, 'index'])->name('pengajar');
            Route::get('/create', [pengajarController::class, 'create'])->name('pengajar.create');
            Route::post('/store', [pengajarController::class, 'store'])->name('pengajar.store');
            Route::get('/{id}', [pengajarController::class, 'edit'])->name('pengajar.edit');
            Route::post('/{id}/update', [pengajarController::class, 'update'])->name('pengajar.update');
            Route::delete('/{id}/destroy', [pengajarController::class, 'destroy'])->name('pengajar.destroy');
            Route::post('/{id}/setnonactive', [pengajarController::class, 'setnonactive'])->name('pengajar.setnonactive');
        });

        Route::group(['prefix' => 'orangtua'], function () {
            Route::get('/', [orangtuaController::class, 'index'])->name('orangtua.index');
            Route::get('/create', [orangtuaController::class, 'create'])->name('orangtua.create');
            Route::post('/store', [orangtuaController::class, 'store'])->name('orangtua.store');
            Route::get('/{id}', [orangtuaController::class, 'edit'])->name('orangtua.edit');
            Route::post('/{id}/update', [orangtuaController::class, 'update'])->name('orangtua.update');
            Route::delete('/{id}/destroy', [orangtuaController::class, 'destroy'])->name('orangtua.destroy');
            Route::post('/{id}/setnonactive', [orangtuaController::class, 'setnonactive'])->name('orangtua.setnonactive');
            Route::get('/{nohp}/wa', [orangtuaController::class, 'wa'])->name('orangtua.wa');
        });
        // Route::get('getpendaftaran/{id}', [pendaftaranController::class, 'show'])->name('pendaftaran.show');
        // pendaftaran
        Route::group(['prefix' => 'pendaftaran'], function () {
            Route::get('/', [pendaftaranController::class, 'index'])->name('pendaftaran.index');
            Route::get('/create', [pendaftaranController::class, 'create'])->name('pendaftaran.create');
            Route::post('/store', [pendaftaranController::class, 'store'])->name('pendaftaran.store');
            Route::get('/{id}', [pendaftaranController::class, 'edit'])->name('pendaftaran.edit');
            Route::post('/{id}/update', [pendaftaranController::class, 'update'])->name('pendaftaran.update');
            // Route::delete('/{id}/destroy', [pendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
            Route::post('/{id}/konfimasi', [pendaftaranController::class, 'konfirmasi'])->name('pendaftaran.konfirmasi');
            Route::get('/{id}/hal_tambahbaru', [pendaftaranController::class, 'hal_tambahbaru'])->name('pendaftaran.hal_tambahbaru');
            Route::get('/{id}/hal_tambahbaruNew', [pendaftaranController::class, 'hal_tambahbaruNew'])->name('pendaftaran.hal_tambahbarunew');
            // get data pendaftaran with parameter id = id_program
            Route::get('/{id}/show', [pendaftaranController::class, 'show'])->name('pendaftaran.show');
            Route::get('/{id}/show-siswa', [pendaftaranController::class, 'show_tambah'])->name('pendaftaran.show.tambah');
        });

        Route::group(['prefix' => 'siswa'], function () {
            Route::get('/', [siswaController::class, 'index'])->name('siswa.index');
            Route::get('/create', [siswaController::class, 'create'])->name('siswa.create');
            Route::post('/store', [siswaController::class, 'store'])->name('siswa.store');
            Route::get('/{id}', [siswaController::class, 'edit'])->name('siswa.edit');
            Route::get('/{id}/show', [siswaController::class, 'show'])->name('siswa.show');
            Route::post('/{id}/update', [siswaController::class, 'update'])->name('siswa.update');
            Route::delete('/{id}/destroy', [siswaController::class, 'destroy'])->name('siswa.destroy');
            Route::get('/{nohp}/wa', [orangtuaController::class, 'wa'])->name('siswa.wa');
        });

        Route::group(['prefix' => 'kelas'], function () {
            Route::get('/hall-pilih-siswa', [kelasController::class, 'halPilihSiswa'])->name('kelas.halpilihsiswa');
            Route::get('/', [kelasController::class, 'index'])->name('kelas.index');
            Route::get('/create', [kelasController::class, 'create'])->name('kelas.create');
            Route::post('/store', [kelasController::class, 'store'])->name('kelas.store');
            Route::get('/{id}', [kelasController::class, 'edit'])->name('kelas.edit');
            Route::get('/{id}/show', [kelasController::class, 'show'])->name('kelas.show');

            Route::post('/{id}/update', [kelasController::class, 'update'])->name('kelas.update');

            // Route::get('/pilihsiswa' , [kelasController::class, 'pilihsiswa'])->name('kelas.pilihsiswa');
            Route::get('/{id}/detailkelas', [kelasController::class, 'detail'])->name('kelas.detail');
            Route::get('/{id}/tambahsiswa', [kelasController::class, 'hal_tambahsiswa'])->name('kelas.hal_tambahsiswa');
            Route::post('/{id}/tambahsiswa', [kelasController::class, 'tambahsiswa'])->name('kelas.update-tambahsiswa');
            Route::delete('/{idkelas}/{idsiswa}/destroy', [kelasController::class, 'destroy'])->name('kelas.siswa.destroy');
            Route::post('/{id}/setnonactive', [kelasController::class, 'setnonactive'])->name('kelas.setnonactive');
        });

        // route group jadwal-premium
        Route::group(['prefix' => 'jadwal-premium'], function () {
            Route::get('/', [jadwalController::class, 'index'])->name('jadwalpremium.index');
            Route::get('/create', [jadwalController::class, 'create'])->name('jadwalpremium.create');
            Route::post('/store', [jadwalController::class, 'store'])->name('jadwalpremium.store');
            Route::get('/{id}', [jadwalController::class, 'edit'])->name('jadwalpremium.edit');
            Route::post('/{id}/update', [jadwalController::class, 'update'])->name('jadwalpremium.update');
            Route::delete('/{id}/destroy', [jadwalController::class, 'destroy'])->name('jadwalpremium.destroy');
            Route::post('/{id}/setnonactive', [jadwalController::class, 'setnonactive'])->name('jadwalpremium.setnonactive');
        });

        // route group jadwal-trial
        Route::group(['prefix' => 'jadwal-trial'], function () {
            Route::get('/', [jadwalController::class, 'index_trial'])->name('jadwaltrial.index');
            Route::get('/create', [jadwalController::class, 'create_trial'])->name('jadwaltrial.create');
            Route::post('/store', [jadwalController::class, 'store_trial'])->name('jadwaltrial.store');
            Route::get('/{id}', [jadwalController::class, 'edit_trial'])->name('jadwaltrial.edit');
            Route::post('/{id}/update', [jadwalController::class, 'update_trial'])->name('jadwaltrial.update');
            Route::delete('/{id}/destroy', [jadwalController::class, 'destroy_trial'])->name('jadwaltrial.destroy');
            Route::post('/{id}/setnonactive', [jadwalController::class, 'setnonactive_trial'])->name('jadwaltrial.setnonactive');
        });

        // route group absensi
        Route::group(['prefix' => 'absensi'], function () {
            Route::get('/', [absensiController::class, 'index'])->name('absensi.index');
            Route::get('/create', [absensiController::class, 'create'])->name('absensi.create');
            Route::post('/store', [absensiController::class, 'store'])->name('absensi.store');
            Route::get('/{id}', [absensiController::class, 'edit'])->name('absensi.edit');
            Route::post('/{id}/update', [absensiController::class, 'update'])->name('absensi.update');
            Route::delete('/{id}/destroy', [absensiController::class, 'destroy'])->name('absensi.destroy');
            Route::post('/{id}/setnonactive', [absensiController::class, 'setnonactive'])->name('absensi.setnonactive');
            Route::get('/{id}/getjadwal', [jadwalController::class, 'getJadwal'])->name('absensi.getjadwal');
            Route::get('/{id}/getjadwalNew', [jadwalController::class, 'newdata'])->name('newgetdatajadwal');
            Route::get('/ajax', [absensiController::class, 'ajax'])->name('absensi.ajax');
        });
        // route group absensi_detail
        Route::group(['prefix' => 'absensi_detail'], function () {
            Route::get('/', [absensiDetailController::class, 'index'])->name('absensi_detail.index');
            Route::get('/create', [absensiDetailController::class, 'create'])->name('absensi_detail.create');
            Route::post('/{id}/store', [absensiDetailController::class, 'store'])->name('absensi_detail.store');
            Route::get('/{id}', [absensiDetailController::class, 'edit'])->name('absensi_detail.edit');
            Route::post('/{id}/update', [absensiDetailController::class, 'update'])->name('absensi_detail.update');
            Route::delete('/{id}/destroy', [absensiDetailController::class, 'destroy'])->name('absensi_detail.destroy');
            // Route::get('/{id}', [absensiDetailController::class, 'show'])->name('absensi_detail.lihat');
            Route::post('/absendong', [absensiDetailController::class, 'absen'])->name('absen.siswa');
            Route::post('{id}/sethadir', [absensiDetailController::class, 'setHadir'])->name('absensi_detail.setHadir');
            Route::post('{id}/setizin', [absensiDetailController::class, 'setIzin'])->name('absensi_detail.setIzin');
            Route::post('{id}/setsakit', [absensiDetailController::class, 'setSakit'])->name('absensi_detail.setSakit');
            Route::post('{id}/setalpa', [absensiDetailController::class, 'setAlpa'])->name('absensi_detail.setAlpa');
        });
    });

    Route::group(['middleware' => 'role:orangtua'], function () {
        Route::post('pendaftaran-program-ortu', [landingController::class, 'daftarprogram'])->name('pendaftaran-create-ortu');
        // Route::get('dashboard-ortu', [dashboardController::class, 'dashboard_ortu'])->name('dashboard-ortu');
        Route::group(['prefix' => 'pendaftaran-ortu'], function () {
            Route::get('/', [pendaftaranController::class, 'index'])->name('pendaftaran.index.ortu');
            Route::get('/{id}/detail', [pendaftaranController::class, 'detail'])->name('pendaftaran.detail');
            Route::post('/siswa-daftar-program-baru', [landingController::class, 'daftarprogram'])->name('pendaftaran.siswa-daftar-program-baru');
            Route::get('/{id}/cetak_kartu', [landingController::class, 'cetakIdentitas'])->name('halaman_cetak_kartu');
            // Route::get('/{id}/cetak_kartu', [landingController::class, 'cetakKartu'])->name('cetak-kartu');
        });
    });
});
