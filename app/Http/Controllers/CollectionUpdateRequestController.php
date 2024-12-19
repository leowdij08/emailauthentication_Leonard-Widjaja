<?php
namespace App\Http\Controllers;

use App\Models\CollectionUpdateRequest; // Model untuk tabel collection_update_requests
use Illuminate\Http\Request; // Untuk menangani request HTTP
use Illuminate\Support\Facades\Auth; // Library autentikasi
use App\Models\Books; // Model untuk tabel books
use App\Models\Journal; // Model untuk tabel journals
use App\Models\CD; // Model untuk tabel CDs
use App\Models\FinalYearProject; // Model untuk tabel final_year_projects
use App\Models\Newspaper; // Model untuk tabel newspapers

class CollectionUpdateRequestController extends Controller
{
    // Menyimpan permintaan update koleksi dari pustakawan
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'catalogue_id' => 'required|integer', // ID katalog harus ada
            'catalogue_type' => 'required|string', // Tipe katalog harus ada
            'update_data' => 'required|array', // Data update harus dalam format array
        ]);

        // Simpan data ke tabel collection_update_requests
        CollectionUpdateRequest::create([
            'catalogue_id' => $request->catalogue_id,
            'catalogue_type' => $request->catalogue_type,
            'librarian_id' => Auth::id(), // ID pustakawan yang membuat permintaan
            'update_data' => $request->update_data, // Data yang akan diupdate
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Update request submitted successfully!');
    }

    // Menampilkan daftar permintaan update yang statusnya pending
    public function index()
    {
        // Ambil semua permintaan update yang statusnya 'pending' dan relasinya dengan pustakawan
        $requests = CollectionUpdateRequest::with('librarian')->where('status', 'pending')->get();

        // Kirim data ke view
        return view('admin.collection_requests.index', compact('requests'));
    }

    // Menyetujui permintaan update koleksi
    public function approve($id)
    {
        // Temukan permintaan berdasarkan ID
        $request = CollectionUpdateRequest::findOrFail($id);

        // Temukan item katalog yang sesuai berdasarkan kategori
        switch ($request->category) {
            case 'book':
                $item = Books::findOrFail($request->catalogue_id);
                break;
            case 'newspaper':
                $item = Newspaper::findOrFail($request->catalogue_id);
                break;
            case 'cd':
                $item = Cd::findOrFail($request->catalogue_id);
                break;
            case 'journal':
                $item = Journal::findOrFail($request->catalogue_id);
                break;
            case 'final year project':
                $item = FinalYearProject::findOrFail($request->catalogue_id);
                break;
            default:
                return redirect()->route('collection.requests.index')->with('error', 'Unknown category');
        }

        // Update data item katalog dengan data baru
        $item->update([
            'title' => $request->new_title,
            'author' => $request->new_author,
            'publisher' => $request->new_publisher,
            'datePublished' => $request->new_datePublished,
            'price' => $request->new_price,
            'stock' => $request->new_stock,
            'onlineLink' => $request->new_onlineLink,
        ]);

        // Tandai permintaan sebagai disetujui
        $request->status = 'approved';
        $request->save();

        // Redirect dengan pesan sukses
        return redirect()->route('collection.requests.index')->with('success', 'Collection update request approved.');
    }

    // Menolak permintaan update koleksi
    public function reject($id)
    {
        // Temukan permintaan berdasarkan ID
        $request = CollectionUpdateRequest::findOrFail($id);

        // Tandai permintaan sebagai ditolak
        $request->status = 'rejected';
        $request->save();

        // Redirect dengan pesan sukses
        return redirect()->route('collection.requests.index')->with('success', 'Collection update request rejected.');
    }
}
