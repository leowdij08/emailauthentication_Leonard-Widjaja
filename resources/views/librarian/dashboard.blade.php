@extends('layouts.app')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    .section-space {
        margin-top: 20px; 
        margin-bottom: 20px;
    }

    .table th, .table td {
        padding: 12px;
    }

    .table .badge {
        font-size: 0.9rem;
    }
</style>

@section('content')
<div class="container">
    <h1>Librarian Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>

    <h2>Collection Management</h2>
    <a href="{{ route('catalogues.index') }}" class="btn btn-primary mb-4">Manage Catalogues</a>

    <h2 class="section-space">Request History</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th class="bg-primary text-white font-weight-bold">Category</th>
                <th class="bg-primary text-white font-weight-bold">Requested Changes</th>
                <th class="bg-primary text-white font-weight-bold">Status</th>
                <th class="bg-primary text-white font-weight-bold">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ ucfirst($request->category) }}</td>
                    <td>
                        <ul>
                            <li><strong>Title:</strong> {{ $request->new_title }}</li>
                            <li><strong>Author:</strong> {{ $request->new_author }}</li>
                            <li><strong>Publisher:</strong> {{ $request->new_publisher }}</li>
                            <li><strong>Price:</strong> {{ number_format($request->new_price, 2) }}</li>
                            <li><strong>Stock:</strong> {{ $request->new_stock }}</li>
                        </ul>
                    </td>
                    <td>
                        @if($request->status == 'pending')
                            <span class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="Request is still under review.">Pending</span>
                        @elseif($request->status == 'approved')
                            <span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Request has been approved.">Approved</span>
                        @elseif($request->status == 'rejected')
                            <span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Request has been rejected.">Rejected</span>
                        @else
                            <span class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Status unknown.">Unknown</span>
                        @endif
                    </td>
                    <td>{{ $request->created_at->format('d M Y H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
