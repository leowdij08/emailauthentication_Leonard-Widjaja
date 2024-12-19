<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Newspaper;
use App\Models\Cd;
use App\Models\Journal;
use App\Models\FinalYearProject;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    /**
     * Constructor untuk HomeController.
     * 
     * @return void
     */
    public function __construct()
    {
        // Middleware 'auth' memastikan hanya pengguna yang terautentikasi yang dapat mengakses controller ini.
        $this->middleware('auth');
    }

    /**
     * Menampilkan halaman dashboard untuk mahasiswa dan dosen.
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Mengambil kategori yang dipilih dari query string; default ke null jika tidak ada.
        $category = $request->get('category', null);

        // Query untuk masing-masing jenis katalog.
        $books = Books::query();
        $newspapers = Newspaper::query();
        $cds = Cd::query();
        $journals = Journal::query();
        $fyp = FinalYearProject::query();

        // Jika kategori dipilih, tambahkan filter kategori ke setiap query.
        if ($category) {
            $books->where('catalogue_type', $category);
            $newspapers->where('catalogue_type', $category);
            $cds->where('catalogue_type', $category);
            $journals->where('catalogue_type', $category);
            $fyp->where('catalogue_type', $category);
        }

        // Dapatkan hasil yang dipaginasi untuk setiap jenis katalog.
        $books = $books->paginate(10);
        $newspapers = $newspapers->paginate(10);
        $cds = $cds->paginate(10);
        $journals = $journals->paginate(10);
        $fyp = $fyp->paginate(10);

        // Gabungkan semua item katalog ke dalam satu koleksi.
        $allItems = collect($books->items())
            ->merge($newspapers->items())
            ->merge($cds->items())
            ->merge($journals->items())
            ->merge($fyp->items());

        // Buat pagination manual untuk koleksi gabungan.
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

        // Tampilkan halaman dashboard dengan data yang telah diproses.
        return view('studentlecturegeneral.dashboard', compact('paginatedItems', 'category'));
    }
}
