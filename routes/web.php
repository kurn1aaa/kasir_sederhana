<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Models\Produk;
use App\Models\Kategori;


Route::get('/', function () { 
    return redirect('/login'); 
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
  
    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });

    Route::get('/dashboard', function () {
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();
        return view('admin.dashboard', compact('totalProduk', 'totalKategori'));
    });

    Route::get('/produk', [ProdukController::class, 'indexAdmin']);
    Route::get('/produk/create', [ProdukController::class, 'create']);
    Route::post('/produk', [ProdukController::class, 'store']);
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit']);
    Route::put('/produk/{id}', [ProdukController::class, 'update']);
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);
    
    Route::resource('kategori', KategoriController::class);
});



Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
   
    Route::get('/', function () {
        return redirect('/user/dashboard');
    });

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    });

    Route::get('/produk', [ProdukController::class, 'indexUser']);
});