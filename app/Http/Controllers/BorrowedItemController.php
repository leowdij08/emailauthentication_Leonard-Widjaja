<?php

namespace App\Http\Controllers;

use App\Models\BorrowedItem; // Model untuk tabel borrowed_items
use App\Models\User; // Model untuk tabel users
use Carbon\Carbon; // Library untuk manipulasi tanggal
use Illuminate\Http\Request; // Untuk menangani permintaan HTTP

class BorrowedItemController extends Controller
{
    // Fungsi untuk meminjam item dari katalog
    public function borrow($id, $category)
    {
        // Mendapatkan user yang sedang login
        $user = auth('web')->user();

        // Menemukan item berdasarkan kategori
        $item = null;
        switch ($category) {
            case 'book':
                $item = \App\Models\Books::findOrFail($id);
                break;
            case 'newspaper':
                $item = \App\Models\Newspaper::findOrFail($id);
                break;
            case 'cd':
                $item = \App\Models\Cd::findOrFail($id);
                break;
            case 'journal':
                $item = \App\Models\Journal::findOrFail($id);
                break;
            case 'final_year_project':
                $item = \App\Models\FinalYearProject::findOrFail($id);
                break;
            default:
                // Jika kategori tidak valid, tampilkan halaman 404
                abort(404, 'Item not found.');
        }

        // Mengecek apakah item tersedia
        if ($item->stock <= 0) {
            // Mengarahkan user kembali dengan pesan error jika stok habis
            $route = $this->getRoleDashboardRoute($user->role);
            return redirect()->route($route)->with('error', 'Item is out of stock.');
        }

        // Menghitung tanggal pengembalian berdasarkan peran user
        $dueDate = $this->getDueDateBasedOnRole($user->role);

        // Membuat catatan peminjaman di tabel borrowed_items
        BorrowedItem::create([
            'borrower_id' => $user->id, // ID user yang meminjam
            'borrowable_id' => $item->id, // ID item yang dipinjam
            'borrowable_type' => get_class($item), // Tipe model dari item
            'borrowed_at' => Carbon::now(), // Tanggal peminjaman
            'due_date' => $dueDate, // Tanggal pengembalian
        ]);

        // Mengurangi stok item sebanyak 1
        $item->decrement('stock');

        // Mengarahkan kembali ke dashboard dengan pesan sukses
        $route = $this->getRoleDashboardRoute($user->role);
        return redirect()->route($route)->with('success', 'Item borrowed successfully!');
    }

    // Fungsi untuk menghitung tanggal pengembalian berdasarkan peran user
    private function getDueDateBasedOnRole($role)
    {
        switch ($role) {
            case 'student':
                return Carbon::now()->addDays(5); // 5 hari untuk mahasiswa
            case 'lecturer':
                return Carbon::now()->addDays(7); // 7 hari untuk dosen
            case 'general':
                return Carbon::now()->addDays(3); // 3 hari untuk general
            default:
                abort(403, 'Invalid role.');
        }
    }

    // Fungsi untuk mendapatkan route dashboard berdasarkan role
    private function getRoleDashboardRoute($role)
    {
        switch ($role) {
            case 'student':
                return 'student.dashboard';
            case 'lecturer':
                return 'lecturer.dashboard';
            case 'general':
                return 'general.dashboard'; // Pastikan route ini ada di file routes
            default:
                abort(403, 'Invalid role.');
        }
    }

    // Fungsi untuk melihat riwayat peminjaman
    public function history()
    {
        // Mendapatkan user yang sedang login
        $user = auth('web')->user();

        // Mengambil data item yang dipinjam beserta model terkait
        $borrowedItems = BorrowedItem::with('borrowable') // Relasi dengan model item
            ->where('borrower_id', $user->id) // Hanya item yang dipinjam user ini
            ->get()
            ->map(function ($item) {
                $today = Carbon::now()->startOfDay();
                $dueDate = Carbon::parse($item->due_date)->startOfDay();

                // Menandai jika item sudah terlambat dikembalikan
                $item->is_overdue = $today->greaterThan($dueDate);

                // Menghitung sisa hari (positif jika belum terlambat, negatif jika terlambat)
                $item->remaining_days = $today->diffInDays($dueDate, false);

                return $item;
            });

        // Mengembalikan view dengan data borrowed items
        return view('studentlecture.borrowedhistory', compact('borrowedItems'));
    }
}
