<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BackupController;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Response;

//route login
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/reset', [AuthController::class, 'reset']);

// route dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

//route barang
Route::resource('/produk', ProdukController::class)->middleware('auth');
Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');

Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');


//route Pelanggan
Route::resource('/akun', PelangganController::class)->middleware('auth');

Route::resource('/kategori', KategoriController::class)->middleware('auth');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::get('/kategori/search', [ProdukController::class, 'search'])->name('kategori.search');

Route::get('/pendapatan', [PendapatanController::class, 'index']);


Route::get('/showPelanggan/{id}', [PesananController::class,'show'] );

Route::get('/api', function () {
    return view('api.api');
});

Route::get('/swagger.yaml', function () {
    $path = resource_path('views/api/swagger.yaml');
    if (!file_exists($path)) {
        abort(404);
    }
    return Response::file($path, [
        'Content-Type' => 'application/x-yaml',
    ]);
});Route::get('/api', function () {
    return view('api.api');
});

Route::get('/backup', function () {
    return view('backup.backup'); // Mengarah ke folder `backup/backup.blade.php`
})->name('backup.page');

Route::post('/backup-now', [BackupController::class, 'backupNow'])->name('backup.now');

/*
Route::get('/kategori', function () {
    return view('kategori.kategori');
});


Route::get('/', function () {
    return view('dashboard.dashboard');
});

Route::get('/produk', function () {
    return view('produk.produk');
});

Route::get('/add', function () {
    return view('produk.add');
});

Route::get('/edit', function () {
    return view('produk.edit');
});

Route::get('/delete', function () {
    return view('produk.produk');
});

Route::get('/view', function () {
    return view('produk.view');
});




Route::get('/akun', function () {
    return view('customer.akunPelanggan');
});


Route::get('/hapus', function () {
    return view('pesanan.pesanan');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/logout', function () {
    return view('auth.login');
});

Route::get('/reset', function () {
    return view('auth.resetPW');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/remove', function () {
    return view('customer.akunPelanggan');
});
*/