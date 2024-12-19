<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\BorrowedItemController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\CollectionUpdateRequestController;
use Illuminate\Support\Facades\Auth;

// Route untuk halaman utama (welcome page)
Route::get('/', function () {
    return view('welcome');
});

// Route untuk autentikasi pengguna
Auth::routes();

/*------------------------------------------
--------------------------------------------
Route untuk pengguna biasa (Normal Users)
--------------------------------------------
--------------------------------------------*/

// Route khusus untuk pengguna dengan role 'student' (mahasiswa)
Route::middleware(['auth', 'user-access:student'])->group(function () {
    Route::get('/student/home', [HomeController::class, 'index'])->name('student.dashboard'); // Dashboard mahasiswa
    Route::get('/student/home/borrow/{id}/{category}', [BorrowedItemController::class, 'borrow'])->name('borrowedItems.borrow.s'); // Pinjam item
    Route::get('/student/home/history', [BorrowedItemController::class, 'history'])->name('borrowed.history.s'); // Riwayat peminjaman
});

// Route khusus untuk pengguna dengan role 'lecturer' (dosen)
Route::middleware(['auth', 'user-access:lecturer'])->group(function () {
    Route::get('/lecturer/home', [HomeController::class, 'index'])->name('lecturer.dashboard'); // Dashboard dosen
    Route::get('/lecturer/home/borrow/{id}/{category}', [BorrowedItemController::class, 'borrow'])->name('borrowedItems.borrow.l'); // Pinjam item
    Route::get('/lecturer/home/history', [BorrowedItemController::class, 'history'])->name('borrowed.history.l'); // Riwayat peminjaman
});

// Route khusus untuk pengguna dengan role 'general'
Route::middleware(['auth', 'user-access:general'])->group(function () {
    Route::get('/general/home', [HomeController::class, 'index'])->name('general.dashboard'); // Dashboard umum
    Route::get('/general/home/borrow/{id}/{category}', [BorrowedItemController::class, 'borrow'])->name('borrowedItems.borrow.g'); // Pinjam item
    Route::get('/general/home/history', [BorrowedItemController::class, 'history'])->name('borrowed.history.g'); // Riwayat peminjaman
});

/*------------------------------------------
--------------------------------------------
Route untuk admin
--------------------------------------------
--------------------------------------------*/

// Route khusus untuk pengguna dengan role 'admin'
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'dashboard'])->name('admin.dashboard'); // Dashboard admin

    // Route untuk pengelolaan pustakawan
    Route::get('/admin/librarians/create', [LibrarianController::class, 'create'])->name('librarian.create'); // Buat pustakawan baru
    Route::post('/admin/librarians/store', [LibrarianController::class, 'store'])->name('librarian.store'); // Simpan pustakawan baru
    Route::delete('/admin/librarians/{id}', [LibrarianController::class, 'destroy'])->name('librarian.destroy'); // Hapus pustakawan

    // Route untuk permintaan pembaruan koleksi
    Route::get('/collection/requests', [CollectionUpdateRequestController::class, 'index'])->name('collection.requests.index'); // Tampilkan permintaan pembaruan
    Route::post('/collection/requests/{id}/approve', [CollectionUpdateRequestController::class, 'approve'])->name('collection.requests.approve'); // Setujui permintaan
    Route::post('/collection/requests/{id}/reject', [CollectionUpdateRequestController::class, 'reject'])->name('collection.requests.reject'); // Tolak permintaan
});

/*------------------------------------------
--------------------------------------------
Route untuk pustakawan
--------------------------------------------
--------------------------------------------*/

// Route khusus untuk pengguna dengan role 'librarian'
Route::middleware(['auth', 'user-access:librarian'])->group(function () {
    Route::get('/librarian/home', [LibrarianController::class, 'index'])->name('librarian.dashboard'); // Dashboard pustakawan
    Route::get('/catalogues/index', [CatalogueController::class, 'index'])->name('catalogues.index'); // Tampilkan katalog
    Route::get('/catalogues/{id}/edit', [CatalogueController::class, 'edit'])->name('catalogues.edit'); // Edit katalog
    Route::put('/catalogues/{id}', [CatalogueController::class, 'update'])->name('catalogues.update'); // Update katalog
    Route::post('/collection/update-request', [CollectionUpdateRequestController::class, 'store'])->name('collection.update-request.store'); // Ajukan permintaan pembaruan koleksi
});

// Route untuk halaman unauthorized
Route::get('/unauthorized', function () {
    return response('Unauthorized', 403);
})->name('unauthorized');

// Route untuk menandai notifikasi sebagai telah dibaca
Route::post('/notifications/{id}/mark-as-read', function ($id) {
    $notification = \App\Models\Notification::findOrFail($id);
    $notification->update(['is_read' => true]);

    return redirect()->back()->with('success', 'Notification marked as read.');
})->name('notifications.mark-as-read');

// Route untuk pengelolaan profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Edit profil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update profil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Hapus profil
});

// Route tambahan untuk autentikasi
require __DIR__.'/auth.php';

// Komentar untuk menghindari pengaktifan ulang rute tertentu
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
