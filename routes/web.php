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
// Route JALUR KHUSUS untuk Form Order Kamu
Route::get('/order/{id}', function ($id) {
    // Kita buat data pura-pura (object) supaya form kamu tidak error baca '$pacar->id'
    $pacar = (object) ['id' => $id];
    
    // Memanggil file: resources/views/formorder/order.blade.php
    return view('formorder.order', compact('pacar'));
})->name('order');

// Route for storing order
// --- ROUTE PENYIMPANAN DATA (DIRECT) ---
Route::post('/order', function (\Illuminate\Http\Request $request) {
    try {
        // 1. Cek apakah Model Order bisa dipanggil
        // Pastikan nama tabel & kolom sesuai dengan form kamu
        
        $order = new \App\Models\Order(); // Mencoba panggil Model
        
        // 2. Masukkan data dari Form ke Database
        // Kiri: Nama Kolom di Database | Kanan: Nama di Form HTML
        $order->pacar_id      = $request->pacar_id;
        $order->nama_pasangan = $request->nama_pasangan; 
        $order->email         = $request->email;
        $order->nomor_wa      = $request->nomor_wa;
        $order->tanggal       = $request->order_date; // Perhatikan: di form namanya 'order_date'
        
        // Status default
        $order->status        = 'pending'; 
        
        // Simpan
        $order->save();

        // 3. Jika Berhasil -> Balik ke Home + Notif
        return redirect('/')->with('success', 'Hore! Pesanan berhasil dibuat. Tunggu admin menghubungi WhatsApp kamu ya! 🚀');

    } catch (\Exception $e) {
        // 4. JIKA ERROR -> TAMPILKAN DI LAYAR (JANGAN DISEMBUNYIKAN)
        return '<div style="background:red; color:white; padding:20px;">
                <h1>GAGAL MENYIMPAN :(</h1>
                <h3>Penyebab Error:</h3>
                <p>'. $e->getMessage() .'</p>
                <hr>
                <p>Screenshot layar ini dan kirim ke AI untuk diperbaiki.</p>
                </div>';
    }
})->name('order.store');
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

// Route::get('/setup-mysql', function () {
//     try {
//         // 1. BERSIHKAN CACHE (Supaya route login muncul lagi)
//         \Illuminate\Support\Facades\Artisan::call('optimize:clear');
//         \Illuminate\Support\Facades\Artisan::call('route:clear');

//         // 2. Update Database
//         \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);

//         // 3. Pastikan Admin Ada
//         // Hapus dulu biar tidak duplikat
//         \App\Models\User::where('email', 'admin@admin.com')->delete();

//         // Buat ulang
//         \App\Models\User::create([
//             'name' => 'Super Admin',
//             'email' => 'admin@admin.com',
//             'password' => bcrypt('password'),
//         ]);

//         return '<h1>SUKSES & REFRESH! 🚀</h1> <p>Cache sudah dibersihkan. Database aman.</p> <p>Silakan coba login sekarang:</p> <ul><li><a href="/admin/login">Login Admin (Filament)</a></li><li><a href="/login">Login Biasa</a></li></ul>';

//     } catch (\Exception $e) {
//         return '<h1>GAGAL :(</h1> <p>' . $e->getMessage() . '</p>';
//     }
// });
// --- ROUTE GANTI PASSWORD ---
Route::get('/ganti-akun', function () {
    // Cari user admin yang lama
    $user = \App\Models\User::where('email', 'admin@admin.com')->first();
    
    if ($user) {
        // MASUKKAN EMAIL & PASSWORD BARU DI BAWAH INI:
        $user->email = 'rentalpacar@gmail.com';  // <--- Ganti jadi email aslimu
        $user->password = bcrypt('admin123');  // <--- Ganti jadi password barumu
        $user->save();
        
        return '<h1>BERHASIL! ✅</h1> <p>Email dan Password sudah diganti. Silakan login ulang.</p>';
    } else {
        return '<h1>GAGAL ❌</h1> <p>User admin lama tidak ditemukan.</p>';
    }
});