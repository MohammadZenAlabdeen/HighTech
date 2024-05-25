<?php

use App\Http\Controllers\MedicineApiController;
use App\Http\Controllers\PharmacyApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/pharmacies',[PharmacyApiController::class,'index']);
Route::post('/medicines/search',[MedicineApiController::class,'search']);