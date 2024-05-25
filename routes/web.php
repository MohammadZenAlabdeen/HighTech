<?php

use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\PharmacyRegisterController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\ViewController;
use App\Models\PharmacyRegister;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard/login',[UserController::class,'showlogin'])->name('Users.showlogin');
Route::get('/dashboard/register',[UserController::class,'showregister'])->name('Users.showregister');
Route::post('/dashboard/loginAttempt',[UserController::class,'login'])->name('Users.login');
Route::post('/dashboard/registerattempt',[UserController::class,'register'])->name('Users.register');

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard',[ViewController::class,'home'])->name('home');
    Route::get('/dashboard/users/',[UserController::class,'index'])->name('Users.index');
    Route::post('/dashboard/logout',[UserController::class,'logout'])->name('Users.logout');
    Route::put('/dashboard/users/update/{user}',[UserController::class,'update'])->name('Users.update');
    Route::get('/dashboard/users/edit/{user}',[UserController::class,'edit'])->name('Users.edit');
    Route::delete('/dashboard/users/delete/{user}',[UserController::class,'delete'])->name('Users.delete');
    Route::get('/dashboard/users/show/{user}', [UserController::class,'show'])->name('Users.show');
    Route::put('/dashboard/users/admin/{user}',[UserController::class,'admin'])->name('Users.admin');

    Route::get('/dashboard/pharmacies/create',[PharmacyRegisterController::class,'create'])->name('PharmaciesRegisters.create');
    Route::post('/dashboard/pharmacies/store',[PharmacyRegisterController::class,'store'])->name('PharmaciesRegisters.store');
Route::get('/dashboard/pharmaciesregisters/{pharmacyRegister}/edit', [PharmacyRegisterController::class, 'edit'])->name('PharmaciesRegisters.edit');
Route::put('/dashboard/pharmaciesregisters/update/{pharmacyRegister}', [PharmacyRegisterController::class, 'update'])->name('PharmaciesRegisters.update');
Route::delete('/dashboard/pharmaciesregisters/delete/{pharmacyRegister}', [PharmacyRegisterController::class, 'destroy'])->name('PharmaciesRegisters.destroy');
Route::put('/dashboard/admin/pharmaciesregisters/accept/{pharmacyRegister}',[PharmacyRegisterController::class,'accept'])->name('PharmaciesRegisters.accept');
Route::delete('/dashboard/admin/pharmaciesregisters/delete/{pharmacyRegister}',[PharmacyRegisterController::class,'accept'])->name('PharmaciesRegisters.decline');
Route::get('/dashboard/admin/pharmaciesregisters/',[PharmacyRegisterController::class,'index'])->name('PharmaciesRegisters.index');

Route::get('/dashboard/pharmacy/show/{pharmacy}',[PharmacyController::class,'show'])->name('Phamracies.show');
Route::patch('/dashboard/pharmacy/state/{pharmacy}',[PharmacyController::class,'state'])->name('Pharmacy.state');
Route::get('/dashboard/admin/pharmacies/',[PharmacyController::class,'index'])->name('Pharmacies.index');
Route::delete('/dashboard/admin/pharmacies/delete/{pharmacy}',[PharmacyController::class,'delete'])->name('Pharmacies.delete');
Route::get('/dashboard/pharmacy/edit/{pharmacy}',[PharmacyController::class,'edit'])->name('Pharmacy.edit');
Route::put('/dashboard/pharmacy/update/{pharmacy}',[PharmacyController::class,'update'])->name('Pharmacy.update');

Route::prefix('/dashboard')->group(function () {
    Route::get('/medicines',[MedicineController::class,'all'])->name('pharmacy.medicines.all');
    Route::get('/pharmacy/{pharmacy}/medicines', [MedicineController::class, 'index'])->name('pharmacy.medicines.index');
    Route::get('/pharmacy/{pharmacy}/medicines/create', [MedicineController::class, 'create'])->name('pharmacy.medicines.create');
    Route::post('/pharmacy/{pharmacy}/medicines', [MedicineController::class, 'store'])->name('pharmacy.medicines.store');
    Route::get('/pharmacy/{pharmacy}/medicines/{medicine}/edit', [MedicineController::class,'edit'])->name('pharmacy.medicines.edit');
    Route::put('/pharmacy/{pharmacy}/medicines/{medicine}/update', [MedicineController::class, 'update'])->name('pharmacy.medicines.update');
    Route::delete('/pharmacy/medicines/{medicine}', [MedicineController::class, 'destroy'])->name('pharmacy.medicines.destroy');
});



});