<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Route untuk daftar produk (bisa diakses tanpa login)
Route::get('/', [HomeController::class, 'index'])->name('products.index');

// Rute yang memerlukan autentikasi (hanya bisa diakses jika user sudah login)
Route::middleware('auth')->group(function () {
    // Rute untuk produk yang lebih spesifik harus di atas rute dinamis
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Formulir produk baru
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');        // Simpan produk baru
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Formulir edit produk
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update'); // Perbarui produk
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update'); // Perbarui produk
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); // Hapus produk
    Route::get('/products/detail/{product}', [ProductController::class, 'detail'])->name('products.detail');   // Tampilkan produk
});

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin']);

Route::get('/user', function () {
    return view('user.dashboard');
})->middleware(['auth', 'role:user']);

// Route dinamis untuk menampilkan produk (bisa diakses tanpa login)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');   // Tampilkan produk

// Route untuk meng-handle upload gambar dari CKEditor (hanya bisa diakses jika user sudah login)
Route::middleware('auth')->post('/upload/image', function (Request $request) {
    if ($request->hasFile('upload')) {
        // Ambil file yang di-upload
        $file = $request->file('upload');

        // Generate nama file yang unik atau bisa gunakan nama asli
        $filename = $file->getClientOriginalName();

        // Simpan file ke dalam storage
        $path = $file->storeAs('public/image/', $filename);

        // Dapatkan URL file yang di-upload
        $url = Storage::url($path);

        // Return URL file ke CKEditor
        return response()->json([
            'uploaded' => true,
            'url' => $url
        ]);
    }

    // Jika gagal upload, return status error
    return response()->json(['uploaded' => false], 400);
})->name('upload.image');

// Route untuk validasi produk
Route::post('/validate-product', [ProductController::class, 'validateProduct'])->name('validate.product');

// Route untuk dashboard (memerlukan autentikasi)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rute untuk profil user yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
