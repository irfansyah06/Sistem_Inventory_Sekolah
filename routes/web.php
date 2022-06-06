<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/forgot-password', function () {
    return view('auth.forgot');
});
Route::get('/', [HomeController::class,'index'])->name('home');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('kategori', KategoriController::class);
Route::get('/laporan/kategori', [KategoriController::class, 'laporan']);

Route::resource('barang', BarangController::class);
Route::get('/laporan/barang', [BarangController::class, 'laporan']);

Route::resource('supplier', SupplierController::class);
Route::get('/laporan/supplier', [SupplierController::class, 'laporan']);

Route::resource('user', UserController::class);
Route::get('/laporan/user', [UserController::class, 'laporan']);
Route::get('password/user/{id}', [UserController::class, 'EditPassword'])->name('user.edit.password');
Route::post('password/user/{id}', [UserController::class, 'UpdatePassword'])->name('user.update.password');

Route::resource('profile', ProfileController::class);
Route::group(['middleware' => 'auth'], function () {
    Route::get('password/{id}', [PasswordController::class, 'edit'])->name('edit.password');
    Route::post('password/{id}', [PasswordController::class, 'update'])->name('update.password');
});
