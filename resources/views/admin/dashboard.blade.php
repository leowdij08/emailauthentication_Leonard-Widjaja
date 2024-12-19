@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>
    <p class="lead">Welcome, <strong>{{ auth()->user()->name }}</strong>!</p>

    <div class="mt-5">
        <h2>Manage Librarians</h2>
        <a href="{{ route('librarian.create') }}" class="btn btn-primary mb-3">Add Librarian</a>

        <h3>Existing Librarians</h3>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($librarians as $librarian)
                <tr>
                    <td>{{ $librarian->name }}</td>
                    <td>{{ $librarian->email }}</td>
                    <td>
                        <form action="{{ route('librarian.destroy', $librarian->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this librarian?')">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        <h2>Manage Collection Update Requests</h2>
        <a href="{{ route('collection.requests.index') }}" class="btn btn-info">View Collection Requests</a>
    </div>
</div>
@endsection
