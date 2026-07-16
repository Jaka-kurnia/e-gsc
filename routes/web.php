<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\IbuController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PemeriksaanAntropometriController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PemeriksaanKonselingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('ibu/excel', [IbuController::class, 'exportExcel'])->name('ibu.excel');
Route::get('ibu/pdf', [IbuController::class, 'exportPdf'])->name('ibu.pdf');
Route::resource('ibu', IbuController::class);

Route::get('anak/excel', [AnakController::class, 'exportExcel'])->name('anak.excel');
Route::get('anak/pdf', [AnakController::class, 'exportPdf'])->name('anak.pdf');
Route::resource('anak', AnakController::class);

Route::get('jadwal/excel', [JadwalController::class, 'exportExcel'])->name('jadwal.excel');
Route::get('jadwal/pdf', [JadwalController::class, 'exportPdf'])->name('jadwal.pdf');
Route::patch('jadwal/{jadwal}/move', [JadwalController::class, 'move'])->name('jadwal.move');
Route::resource('jadwal', JadwalController::class);

Route::get('imunisasi/excel', [ImunisasiController::class, 'exportExcel'])->name('imunisasi.excel');
Route::get('imunisasi/pdf', [ImunisasiController::class, 'exportPdf'])->name('imunisasi.pdf');
Route::resource('imunisasi', ImunisasiController::class);

Route::get('pemeriksaan/excel', [PemeriksaanController::class, 'exportExcel'])->name('pemeriksaan.excel');
Route::get('pemeriksaan/pdf', [PemeriksaanController::class, 'exportPdf'])->name('pemeriksaan.pdf');
Route::resource('pemeriksaan', PemeriksaanController::class);


Route::get('pemeriksaan_antropometri/excel', [PemeriksaanAntropometriController::class, 'exportExcel'])->name('pemeriksaan_antropometri.excel');
Route::get('pemeriksaan_antropometri/pdf', [PemeriksaanAntropometriController::class, 'exportPdf'])->name('pemeriksaan_antropometri.pdf');
Route::resource('pemeriksaan_antropometri', PemeriksaanAntropometriController::class);

Route::get('pemeriksaan_konseling/excel', [PemeriksaanKonselingController::class, 'exportExcel'])->name('pemeriksaan_konseling.excel');
Route::get('pemeriksaan_konseling/pdf', [PemeriksaanKonselingController::class, 'exportPdf'])->name('pemeriksaan_konseling.pdf');
Route::resource('pemeriksaan_konseling',PemeriksaanKonselingController::class);