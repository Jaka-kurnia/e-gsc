<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\IbuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ibu', IbuController::class);

Route::resource('anak', AnakController::class);
