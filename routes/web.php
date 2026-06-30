<?php

use App\Http\Controllers\IbuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('test');
});

Route::resource('ibu', IbuController::class);
