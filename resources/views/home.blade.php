@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Baris untuk memposisikan konten di tengah -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card untuk menampilkan informasi dashboard -->
            <div class="card">
                <!-- Header card yang menampilkan judul -->
                <div class="card-header">{{ __('Dashboard') }}</div>

                <!-- Body card untuk menampilkan konten utama -->
                <div class="card-body">
                    <!-- Menampilkan pesan sukses jika ada status dalam sesi -->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Menampilkan pesan bahwa pengguna telah berhasil login -->
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
