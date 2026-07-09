<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\IbuController;
use App\Http\Controllers\JadwalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ibu', IbuController::class);

Route::resource('anak', AnakController::class);

Route::resource('jadwal', JadwalController::class);