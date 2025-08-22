<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route barang
Route::get('/benda',[App\Http\Controllers\BarangController::class,'index']);
Route::get('/benda/{id}',[App\Http\Controllers\BarangController::class,'show']);
Route::post('/benda',[App\Http\Controllers\BarangController::class,'store']);
Route::match(['put','patch'],'/benda/{id}',[App\Http\Controllers\BarangController::class,'update']);
Route::delete('/benda/{id}',[App\Http\Controllers\BarangController::class,'destroy']);
Route::get('/benda/category/{category}',[App\Http\Controllers\BarangController::class,'category']);

//Pengiriman barang
Route::get('/pengiriman',[App\Http\Controllers\PengirimanController::class,'index']);
Route::get('/pengiriman/{id}',[App\Http\Controllers\PengirimanController::class,'show']);