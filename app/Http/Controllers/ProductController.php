<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Product; 

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        // Mengambil semua produk yang diurutkan berdasarkan waktu terbaru dan dipaginasi
        $products = Product::latest()->paginate(10);

        // Merender tampilan dengan data produk
        return view('products.index', compact('products'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        // Menampilkan halaman form untuk membuat produk baru
        return view('products.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input dari form
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048', // Validasi gambar
            'title'         => 'required|min:5', // Validasi judul produk
            'description'   => 'required|min:10', // Validasi deskripsi produk
            'price'         => 'required|numeric', // Validasi harga produk
            'stock'         => 'required|numeric' // Validasi stok produk
        ]);

        // Upload gambar produk
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName()); // Menyimpan gambar dengan nama hash

        // Membuat produk baru dan menyimpannya ke database
        Product::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);

        // Mengarahkan pengguna kembali dengan pesan sukses
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        // Mengambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Merender tampilan dengan data produk
        return view('products.show', compact('product'));
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        // Mengambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Merender tampilan dengan data produk untuk diedit
        return view('products.edit', compact('product'));
    }
        
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi input dari form
        $request->validate([
            'image'         => 'image|mimes:jpeg,jpg,png|max:2048', // Validasi gambar (opsional)
            'title'         => 'required|min:5', // Validasi judul produk
            'description'   => 'required|min:10', // Validasi deskripsi produk
            'price'         => 'required|numeric', // Validasi harga produk
            'stock'         => 'required|numeric' // Validasi stok produk
        ]);

        // Mengambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Memeriksa apakah ada gambar yang diunggah
        if ($request->hasFile('image')) {

            // Mengupload gambar baru
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            // Menghapus gambar lama jika ada
            Storage::delete('public/products/'.$product->image);

            // Memperbarui produk dengan gambar baru dan data lainnya
            $product->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock
            ]);

        } else {

            // Memperbarui produk tanpa mengubah gambar
            $product->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock
            ]);
        }

        // Mengarahkan pengguna kembali dengan pesan sukses
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // Mengambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Menghapus gambar produk dari storage
        Storage::delete('public/products/'. $product->image);

        // Menghapus produk dari database
        $product->delete();

        // Mengarahkan pengguna kembali dengan pesan sukses
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
