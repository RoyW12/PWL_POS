<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;


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

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);

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
    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/level', [LevelController::class, 'index']);
        Route::post('/level/list', [LevelController::class, 'list']); // untuk list json datatables
        Route::get('/level/create', [LevelController::class, 'create']);
        Route::post('/level', [LevelController::class, 'store']);
        Route::get('/level/{id}/edit', [LevelController::class, 'edit']); // untuk tampilkan form edit
        Route::put('/level/{id}', [LevelController::class, 'update']); // untuk proses update data
        Route::delete('/level/{id}', [LevelController::class, 'destroy']); // untuk proses hapus data
    });



    // Route::group(['prefix' => 'level'], function () {
    //     Route::get('/', [LevelController::class, 'index']);           // menampilkan halaman awal user
    //     Route::post('/list', [LevelController::class, 'list']);       // menampilkan data user dalam bentuk json untuk datatables
    //     Route::get('/create', [LevelController::class, 'create']);    // menampilkan halaman form tambah user
    //     Route::post('/', [LevelController::class, 'store']);          // menyimpan data user baru
    //     Route::get('/{id}/edit', [LevelController::class, 'edit']);   // menampilkan halaman form edit user
    //     Route::put('/{id}', [LevelController::class, 'update']);      // menyimpan perubahan data user
    //     Route::delete('/{id}', [LevelController::class, 'destroy']);  // menghapus data user
    //     Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan form tambah user (AJAX)
    //     Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menyimpan user baru (AJAX)
    //     Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan form edit user (AJAX)
    //     Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan user (AJAX)
    //     Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Menghapus user
    //     Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Menghapus user
    //     Route::get('/{id}', [LevelController::class, 'show']);        // menampilkan detail user
    // });





    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']);           // menampilkan halaman awal user
        Route::post('/list', [KategoriController::class, 'list']);       // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [KategoriController::class, 'create']);    // menampilkan halaman form tambah user
        Route::post('/', [KategoriController::class, 'store']);          // menyimpan data user baru
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);   // menampilkan halaman form edit user
        Route::put('/{id}', [KategoriController::class, 'update']);      // menyimpan perubahan data user
        Route::delete('/{id}', [KategoriController::class, 'destroy']);  // menghapus data user
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // Menampilkan form tambah user (AJAX)
        Route::post('/ajax', [KategoriController::class, 'store_ajax']);
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // Menampilkan form edit user (AJAX)
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // Menyimpan perubahan user (AJAX)
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // Menghapus user
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);




        Route::get('/{id}', [KategoriController::class, 'show']);        // menampilkan detail user

    });
    Route::middleware(['authorize:ADM,MNG'])->group(function () {
        Route::get('/barang', [BarangController::class, 'index']);
        Route::post('/barang/list', [BarangController::class, 'list']);
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // ajax form create
        Route::post('/barang_ajax', [BarangController::class, 'store_ajax']); // ajax store
        Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // ajax form edit
        Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // ajax update
        Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // ajax form confirm
        Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // ajax delete
    });

    // Route::group(['prefix' => 'barang'], function () {
    //     Route::get('/', [BarangController::class, 'index']);           // menampilkan halaman awal user
    //     Route::post('/list', [BarangController::class, 'list']);       // menampilkan data user dalam bentuk json untuk datatables
    //     Route::get('/create', [BarangController::class, 'create']);    // menampilkan halaman form tambah user
    //     Route::post('/', [BarangController::class, 'store']);          // menyimpan data user baru
    //     Route::get('/{id}/edit', [BarangController::class, 'edit']);   // menampilkan halaman form edit user
    //     Route::put('/{id}', [BarangController::class, 'update']);      // menyimpan perubahan data user
    //     Route::delete('/{id}', [BarangController::class, 'destroy']);  // menghapus data user

    //     Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan form tambah user (AJAX)
    //     Route::post('/ajax', [BarangController::class, 'store_ajax']);
    //     Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // Menampilkan form edit user (AJAX)
    //     Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // Menyimpan perubahan user (AJAX)
    //     Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Menghapus user
    //     Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
    //     Route::get('/{id}', [BarangController::class, 'show']);        // menampilkan detail user

    // });
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
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);   // menampilkan halaman form edit user
        Route::put('/{id}', [SupplierController::class, 'update']);      // menyimpan perubahan data user
        Route::delete('/{id}', [SupplierController::class, 'destroy']);  // menghapus data user

        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // Menampilkan form tambah user (AJAX)
        Route::post('/ajax', [SupplierController::class, 'store_ajax']);
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // Menampilkan form edit user (AJAX)
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // Menyimpan perubahan user (AJAX)
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // Menghapus user
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);

        Route::get('/{id}', [SupplierController::class, 'show']);        // menampilkan detail user

    });
});
