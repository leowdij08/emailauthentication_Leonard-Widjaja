@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1 class="mt-4">Library Catalog</h1>

    <!-- Tombol untuk melihat riwayat peminjaman -->
    <div class="mb-4">
        <!-- Menampilkan tombol berdasarkan peran pengguna -->
        @if (auth()->user()->role == 'student')
            <a href="{{ route('borrowed.history.s') }}" class="btn btn-secondary">View Borrowing History</a>
        @elseif (auth()->user()->role == 'lecturer')
            <a href="{{ route('borrowed.history.l') }}" class="btn btn-secondary">View Borrowing History</a>
        @elseif (auth()->user()->role == 'general')
            <a href="{{ route('borrowed.history.g') }}" class="btn btn-secondary">View Borrowing History</a>
        @endif
    </div>

    <!-- Filter berdasarkan kategori -->
    <form method="GET" action="{{ route(auth()->user()->role . '.dashboard') }}" class="mb-4">
        <label for="category">Select Category:</label>
        <select name="category" id="category" class="form-control w-50 d-inline-block" onchange="this.form.submit()">
            <!-- Opsi untuk memilih kategori -->
            <option value="">All Categories</option>
            <option value="book" {{ request('category') == 'book' ? 'selected' : '' }}>Books</option>
            <option value="newspaper" {{ request('category') == 'newspaper' ? 'selected' : '' }}>Newspapers</option>
            <option value="cd" {{ request('category') == 'cd' ? 'selected' : '' }}>CDs</option>
            <option value="journal" {{ request('category') == 'journal' ? 'selected' : '' }}>Journals</option>
            <option value="final year project" {{ request('category') == 'final year project' ? 'selected' : '' }}>Final Year Projects</option>
        </select>
    </form>

    <!-- Tabel katalog -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Title</th> <!-- Kolom untuk judul item -->
                <th>Author</th> <!-- Kolom untuk penulis -->
                <th>Publisher</th> <!-- Kolom untuk penerbit -->
                <th>Published Date</th> <!-- Kolom untuk tanggal terbit -->
                <th>Category</th> <!-- Kolom untuk kategori -->
                <th>Price (Rp)</th> <!-- Kolom untuk harga -->
                <th>Stock</th> <!-- Kolom untuk stok -->
                <th>Borrow</th> <!-- Kolom untuk tombol peminjaman -->
            </tr>
        </thead>
        <tbody>
            <!-- Iterasi data katalog -->
            @foreach($paginatedItems as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->author }}</td>
                    <td>{{ $item->publisher }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->datePublished)->format('d M Y') }}</td> <!-- Format tanggal -->
                    <td>{{ $item->catalogue_type }}</td>
                    <td>{{ number_format($item->price ?? 0, 0, ',', '.') }}</td> <!-- Format harga -->
                    <td>{{ $item->stock }}</td>
                    <td>
                        <!-- Tombol peminjaman berdasarkan peran pengguna -->
                        @if (auth()->user()->role == 'student' && $item->catalogue_type == 'book')
                            <a href="{{ route('borrowedItems.borrow.s',  ['id' => $item->id, 'category' => $item->catalogue_type]) }}" class="btn btn-primary">Borrow</a>
                        @elseif (auth()->user()->role == 'lecturer')
                            <a href="{{ route('borrowedItems.borrow.l',  ['id' => $item->id, 'category' => $item->catalogue_type]) }}" class="btn btn-primary">Borrow</a>
                        @elseif (auth()->user()->role == 'general')
                            <a href="{{ route('borrowedItems.borrow.g',  ['id' => $item->id, 'category' => $item->catalogue_type]) }}" class="btn btn-primary">Borrow</a>
                        @else
                            <span class="text-muted">Not available for your role</span>
                        @endif
                        @else
                            <span class="text-muted">Not available for your role</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Navigasi pagination -->
    <div class="pagination justify-content-center">
        {{ $paginatedItems->links() }}
    </div>
</div>
@endsection
