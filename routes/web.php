<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('landing');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::view('/profile/jule', 'jule')->name('profile.jule');
Route::view('/lucinta', 'identitas.lucinta')->name('lucinta');
Route::view('/cecep', 'identitas.cecep')->name('cecep');

// Protected admin routes
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'showDashboard'])->name('admin.dashboard');
});

// Route for Jule page
Route::get('/jule', function () {
    return view('identitas.jule');
})->name('jule');

// Route for Order page
Route::get('/order/{pacar_id}', [App\Http\Controllers\OrderController::class, 'showOrderForm'])->name('order');

// Route for storing order
Route::post('/order', [App\Http\Controllers\OrderController::class, 'storeOrder'])->name('order.store');

// Route for updating order
Route::put('/order/{id}', [App\Http\Controllers\OrderController::class, 'updateOrder'])->name('order.update');

// Route for getting order data for edit
Route::get('/admin/dashboard/edit/{id}', [App\Http\Controllers\AuthController::class, 'getOrder'])->name('admin.order.edit');

// Route for deleting order
Route::delete('/order/{id}', [App\Http\Controllers\OrderController::class, 'deleteOrder'])->name('order.delete');

// Route for Cecep page
Route::get('/cecep', function () {
    return view('identitas.cecep');
})->name('cecep');

// --- TARUH KODINGAN INI DI PALING BAWAH FILE ---

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// --- SETUP DATABASE MYSQL OTOMATIS ---
Route::get('/setup-mysql', function () {
    try {
        // 1. Perintah Migrate (Bikin Tabel)
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        
        // 2. Hapus user lama jika ada (biar bersih)
        \App\Models\User::where('email', 'admin@admin.com')->delete();
        
        // 3. Buat User Admin Baru
        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'), // passwordnya: password
        ]);

        return '<h1>SUKSES! 🎉</h1> <p>Database MySQL sudah aktif. Admin sudah dibuat.</p> <a href="/admin/login">Klik disini untuk Login</a>';
        
    } catch (\Exception $e) {
        // Kalau error, tampilkan errornya biar ketahuan salah dimana
        return '<h1>GAGAL :(</h1> <p>Pesan Error: ' . $e->getMessage() . '</p>';
    }
});