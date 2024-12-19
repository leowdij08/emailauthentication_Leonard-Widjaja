@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Library Catalog</h1>

    <!-- Form untuk memilih kategori katalog -->
    <form method="GET" action="{{ route('catalogues.index') }}" class="mb-4">
        <label for="category">Select Category:</label>
        <select name="category" id="category" class="form-control w-50 d-inline-block" onchange="this.form.submit()">
            <!-- Opsi kategori dengan kondisi untuk menampilkan kategori yang dipilih -->
            <option value="">All Categories</option>
            <option value="book" {{ request('category') == 'book' ? 'selected' : '' }}>Books</option>
            <option value="newspaper" {{ request('category') == 'newspaper' ? 'selected' : '' }}>Newspapers</option>
            <option value="cd" {{ request('category') == 'cd' ? 'selected' : '' }}>CDs</option>
            <option value="journal" {{ request('category') == 'journal' ? 'selected' : '' }}>Journals</option>
            <option value="final year project" {{ request('category') == 'final year project' ? 'selected' : '' }}>Final Year Projects</option>
        </select>
    </form>

    <!-- Tabel untuk menampilkan data katalog -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Published Date</th>
                <th>Category</th>
                <th>Price (Rp)</th>
                <th>Stock</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop untuk menampilkan item katalog -->
            @foreach($paginatedItems as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->author }}</td>
                    <td>{{ $item->publisher }}</td>
                    <!-- Format tanggal menjadi format 'dd M yyyy' -->
                    <td>{{ \Carbon\Carbon::parse($item->datePublished)->format('d M Y') }}</td>
                    <td>{{ $item->catalogue_type }}</td>
                    <!-- Format harga menjadi format yang lebih mudah dibaca -->
                    <td>{{ number_format($item->price ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $item->stock }}</td>
                    <!-- Tombol untuk mengedit item katalog -->
                    <td>
                        <a href="{{ route('catalogues.edit', ['id' => $item->id, 'category' => $item->catalogue_type]) }}" 
                           class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Link untuk navigasi halaman berikutnya -->
    <div class="pagination justify-content-center">
        {{ $paginatedItems->links() }}
    </div>
</div>
@endsection
