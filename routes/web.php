<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
Route::get('/', function () {
    return view('welcome');
});


Route::view('admin-login','admin-login');

Route::post('admin-login',[AdminController::class,'login']);