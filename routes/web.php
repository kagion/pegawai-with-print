<?php


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

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return view('/home');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('print-id/{pegawai}', [App\Http\Controllers\PrintController::class, 'printId'])->name('print-id');
Route::get('print-id-bulk', [App\Http\Controllers\PrintController::class, 'printIdBulk'])->name('print-id-bulk');
Route::post('store', [App\Http\Controllers\PegawaiController::class, 'store'])->name('store');
Route::put('update/{pegawai}', [App\Http\Controllers\PegawaiController::class, 'update'])->name('update');
Route::delete('delete/{pegawai}', [App\Http\Controllers\PegawaiController::class, 'destroy'])->name('delete');
Route::post('store-bulk', [App\Http\Controllers\PegawaiController::class, 'storeBulk'])->name('store-bulk');


