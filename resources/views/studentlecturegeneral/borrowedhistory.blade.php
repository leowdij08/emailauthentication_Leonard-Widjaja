@extends('layouts.app')
<!-- Menggunakan Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="container">
    <h1 class="mt-4">Borrowing History</h1>

    <!-- Menampilkan pesan jika tidak ada riwayat peminjaman -->
    @if($borrowedItems->isEmpty())
        <p>You have no borrowing history.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th> <!-- Kolom untuk judul item -->
                    <th>Category</th> <!-- Kolom untuk kategori item -->
                    <th>Borrowed Date</th> <!-- Kolom untuk tanggal peminjaman -->
                    <th>Due Date</th> <!-- Kolom untuk tanggal pengembalian -->
                    <th>Status</th> <!-- Kolom untuk status peminjaman -->
                    <th>Remaining/Overdue</th> <!-- Kolom untuk sisa hari atau keterlambatan -->
                </tr>
            </thead>
            <tbody>
                <!-- Iterasi data riwayat peminjaman -->
                @foreach($borrowedItems as $item)
                    <tr>
                        <td>{{ $item->borrowable->title }}</td>
                        <td>{{ ucfirst(class_basename($item->borrowable_type)) }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->borrowed_at)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->due_date)->format('d M Y') }}</td>
                        <td>
                            <!-- Menentukan status peminjaman (Overdue atau On Time) -->
                            @if($item->is_overdue)
                                <span class="badge badge-danger">Overdue</span>
                            @else
                                <span class="badge badge-success">On Time</span>
                            @endif
                        </td>
                        <td>
                            <!-- Menampilkan jumlah hari sisa atau keterlambatan -->
                            @if($item->is_overdue)
                                {{ ceil(abs($item->remaining_days)) }} days overdue
                            @else
                                {{ ceil($item->remaining_days) }} days remaining
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
