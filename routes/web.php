<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::get('/pesanan', [AdminController::class, 'index'])->name('pesanan.index');
Route::get('/customer', [CustomerController::class, 'index'])->name('admin.index');
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::prefix('pesanan')->group(function(){
Route::get('add', [AdminController::class, 'create'])->name('pesanan.create');
Route::post('store', [AdminController::class, 'store'])->name('pesanan.store');
Route::get('edit/{id}', [AdminController::class, 'edit'])->name('pesanan.edit');
Route::post('update/{id}', [AdminController::class,'update'])->name('pesanan.update');
Route::post('delete/{id}', [AdminController::class,'delete'])->name('pesanan.delete');
Route::post('softDelete/{id}', [AdminController::class,'softDelete'])->name('pesanan.softDelete');
});

Route::prefix('customer')->group(function(){
Route::get('add', [CustomerController::class, 'create'])->name('admin.create');
Route::post('store', [CustomerController::class, 'store'])->name('admin.store');
Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('admin.edit');
Route::post('update/{id}', [CustomerController::class, 'update'])->name('admin.update');
Route::post('delete/{id}', [CustomerController::class, 'delete'])->name('admin.delete');
Route::post('softDelete/{id}', [CustomerController::class,'softDelete'])->name('admin.softDelete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
