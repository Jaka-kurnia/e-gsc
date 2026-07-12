<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\IbuController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\JadwalController;
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
Route::resource('jadwal', JadwalController::class);

Route::get('imunisasi/excel', [ImunisasiController::class, 'exportExcel'])->name('imunisasi.excel');
Route::get('imunisasi/pdf', [ImunisasiController::class, 'exportPdf'])->name('imunisasi.pdf');
Route::resource('imunisasi',ImunisasiController::class);
