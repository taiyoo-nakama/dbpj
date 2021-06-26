<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\PersonController;

Route::get('/',[PersonController::class,'index']);
Route::get('/find',[PersonController::class,'find']);
Route::post('/find',[PersonController::class,'search']);
Route::get('/add',[PersonController::class,'add']);
Route::post('/add',[PersonController::class,'create']);
Route::get('/edit',[PersonController::class,'edit']);
Route::post('/edit',[PersonController::class,'update']);
Route::get('/delete',[PersonController::class,'delete']);
Route::post('/delete',[PersonController::class,'remove']);
Route::get('/board',[BoardController::class,'index']);
Route::get('/board/add',[BoardController::class,'add']);
Route::post('/board/add',[BoardController::class,'create']);
Route::get('/person',[PersonController::class,'index']);
