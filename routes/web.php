<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;

Route::get('/',[PersonController::class,'index']);
Route::get('/find',[PersonController::class,'find']);
Route::post('/find',[PersonController::class,'search']);
Route::get('/add',[PersonController::class,'add']);
Route::post('/add',[PersonController::class,'create']);