<?php

namespace App\Http\Controllers;

use App\Models\Books; // Model untuk tabel books
use App\Models\Newspaper; // Model untuk tabel newspapers
use App\Models\Cd; // Model untuk tabel CDs
use App\Models\Journal; // Model untuk tabel journals
use App\Models\FinalYearProject; // Model untuk tabel final_year_projects
use App\Models\BorrowedItem; // Model untuk tabel borrowed_items
use Illuminate\Http\Request; // Untuk menangani permintaan HTTP
use Illuminate\Pagination\LengthAwarePaginator; // Library untuk pagination manual
use App\Models\CollectionUpdateRequest; // Model untuk tabel collection_update_requests
use Illuminate\Support\Facades\Auth; // Untuk autentikasi
use Carbon\Carbon; // Library untuk manipulasi tanggal

class CatalogueController extends Controller
{
    // Menampilkan daftar katalog dengan pagination
    public function index(Request $request)
    {
        $category = $request->get('category', null); // Ambil kategori dari query string

        // Query untuk masing-masing jenis katalog
        $books = Books::query();
        $newspapers = Newspaper::query();
        $cds = Cd::query();
        $journals = Journal::query();
        $fyp = FinalYearProject::query();

        // Filter berdasarkan kategori jika ada
        if ($category) {
            $books->where('catalogue_type', $category);
            $newspapers->where('catalogue_type', $category);
            $cds->where('catalogue_type', $category);
            $journals->where('catalogue_type', $category);
            $fyp->where('catalogue_type', $category);
        }

        // Pagination masing-masing item
        $books = $books->paginate(10);
        $newspapers = $newspapers->paginate(10);
        $cds = $cds->paginate(10);
        $journals = $journals->paginate(10);
        $fyp = $fyp->paginate(10);

        // Menggabungkan semua hasil pagination
        $allItems = collect($books->items())
            ->merge($newspapers->items())
            ->merge($cds->items())
            ->merge($journals->items())
            ->merge($fyp->items());

        // Pagination manual untuk gabungan koleksi
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;
        $itemsForCurrentPage = $allItems->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedItems = new LengthAwarePaginator(
            $itemsForCurrentPage,
            $allItems->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Kirim data ke view
        return view('catalogues.index', compact('paginatedItems', 'category'));
    }

    // Menampilkan form edit untuk item katalog tertentu
    public function edit($id, Request $request)
    {
        $category = $request->get('category');

        // Menemukan item berdasarkan kategori
        switch ($category) {
            case 'book':
                $item = Books::findOrFail($id);
                break;
            case 'newspaper':
                $item = Newspaper::findOrFail($id);
                break;
            case 'cd':
                $item = Cd::findOrFail($id);
                break;
            case 'journal':
                $item = Journal::findOrFail($id);
                break;
            case 'final year project':
                $item = FinalYearProject::findOrFail($id);
                break;
            default:
                abort(404, 'Category not found.');
        }

        // Kirim data item ke view
        return view('catalogues.edit', compact('item', 'category'));
    }

    // Menyimpan permintaan update untuk item katalog tertentu
    public function update(Request $request, $id)
    {
        $category = $request->get('category');

        // Menemukan item berdasarkan kategori
        switch ($category) {
            case 'book':
                $item = Books::findOrFail($id);
                break;
            case 'newspaper':
                $item = Newspaper::findOrFail($id);
                break;
            case 'cd':
                $item = Cd::findOrFail($id);
                break;
            case 'journal':
                $item = Journal::findOrFail($id);
                break;
            case 'final year project':
                $item = FinalYearProject::findOrFail($id);
                break;
            default:
                abort(404, 'Category not found.');
        }

        // Validasi data input
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'datePublished' => 'nullable|date',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
            'onlineLink' => 'nullable|url',
        ]);

        // Pastikan user terautentikasi
        $this->middleware('auth');

        // Simpan permintaan update ke tabel collection_update_requests
        $updateRequest = new CollectionUpdateRequest();
        $updateRequest->user_id = auth('web')->id(); // ID user yang mengajukan
        $updateRequest->category = $category;
        $updateRequest->catalogue_id = $id;
        $updateRequest->new_title = $request->get('title');
        $updateRequest->new_author = $request->get('author');
        $updateRequest->new_publisher = $request->get('publisher');
        $updateRequest->new_datePublished = $request->get('datePublished');
        $updateRequest->new_price = $request->get('price');
        $updateRequest->new_stock = $request->get('stock');
        $updateRequest->new_onlineLink = $request->get('onlineLink');
        $updateRequest->save();

        // Redirect dengan pesan sukses
        return redirect()->route('catalogues.index')->with('success', 'Catalogue update request submitted. Awaiting admin approval.');
    }
}
