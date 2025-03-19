<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;


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



route::get('/', [WelcomeController::class, 'index']);
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); // Menampilkan halaman user
    Route::post('/list', [UserController::class, 'list']); // Menampilkan data user dalam bentuk JSON (DataTables)
    Route::get('/create', [UserController::class, 'create']); // Menampilkan form tambah user
    Route::post('/', [UserController::class, 'store']); // Menyimpan user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan form tambah user (AJAX)
    Route::post('/ajax', [UserController::class, 'store_ajax']); // Menyimpan user baru (AJAX)
    Route::get('/{id}', [UserController::class, 'show']); // Menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // Menampilkan form edit user
    Route::put('/{id}', [UserController::class, 'update']); // Menyimpan perubahan user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan form edit user (AJAX)
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan user (AJAX)

    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Menghapus user
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Menghapus user

    Route::delete('/{id}', [UserController::class, 'destroy']); // Menghapus user

});


Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']);           // menampilkan halaman awal user
    Route::post('/list', [LevelController::class, 'list']);       // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']);    // menampilkan halaman form tambah user
    Route::post('/', [LevelController::class, 'store']);          // menyimpan data user baru
    Route::get('/{id}', [LevelController::class, 'show']);        // menampilkan detail user
    Route::get('/{id}/edit', [LevelController::class, 'edit']);   // menampilkan halaman form edit user
    Route::put('/{id}', [LevelController::class, 'update']);      // menyimpan perubahan data user
    Route::delete('/{id}', [LevelController::class, 'destroy']);  // menghapus data user
});
Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']);           // menampilkan halaman awal user
    Route::post('/list', [KategoriController::class, 'list']);       // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);    // menampilkan halaman form tambah user
    Route::post('/', [KategoriController::class, 'store']);          // menyimpan data user baru
    Route::get('/{id}', [KategoriController::class, 'show']);        // menampilkan detail user
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);   // menampilkan halaman form edit user
    Route::put('/{id}', [KategoriController::class, 'update']);      // menyimpan perubahan data user
    Route::delete('/{id}', [KategoriController::class, 'destroy']);  // menghapus data user
});
Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']);           // menampilkan halaman awal user
    Route::post('/list', [BarangController::class, 'list']);       // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']);    // menampilkan halaman form tambah user
    Route::post('/', [BarangController::class, 'store']);          // menyimpan data user baru
    Route::get('/{id}', [BarangController::class, 'show']);        // menampilkan detail user
    Route::get('/{id}/edit', [BarangController::class, 'edit']);   // menampilkan halaman form edit user
    Route::put('/{id}', [BarangController::class, 'update']);      // menyimpan perubahan data user
    Route::delete('/{id}', [BarangController::class, 'destroy']);  // menghapus data user
});
Route::group(['prefix' => 'stok'], function () {
    Route::get('/', [StokController::class, 'index']);           // menampilkan halaman awal user
    Route::post('/list', [StokController::class, 'list']);       // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [StokController::class, 'create']);    // menampilkan halaman form tambah user
    Route::post('/', [StokController::class, 'store']);          // menyimpan data user baru
    Route::get('/{id}', [StokController::class, 'show']);        // menampilkan detail user
    Route::get('/{id}/edit', [StokController::class, 'edit']);   // menampilkan halaman form edit user
    Route::put('/{id}', [StokController::class, 'update']);      // menyimpan perubahan data user
    Route::delete('/{id}', [StokController::class, 'destroy']);  // menghapus data user
});
Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index']);           // menampilkan halaman awal user
    Route::post('/list', [SupplierController::class, 'list']);       // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);    // menampilkan halaman form tambah user
    Route::post('/', [SupplierController::class, 'store']);          // menyimpan data user baru
    Route::get('/{id}', [SupplierController::class, 'show']);        // menampilkan detail user
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);   // menampilkan halaman form edit user
    Route::put('/{id}', [SupplierController::class, 'update']);      // menyimpan perubahan data user
    Route::delete('/{id}', [SupplierController::class, 'destroy']);  // menghapus data user
});
