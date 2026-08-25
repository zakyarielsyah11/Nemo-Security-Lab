@extends('layouts.app')

@section('title', 'Client Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>{{ $client->name }}</h3>
        <div>
            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th class="bg-light">ID</th><td>{{ $client->id }}</td></tr>
                <tr><th class="bg-light">Name</th><td>{{ $client->name }}</td></tr>
                <tr><th class="bg-light">Email</th><td>{{ $client->email ?? '-' }}</td></tr>
                <tr><th class="bg-light">Phone</th><td>{{ $client->phone ?? '-' }}</td></tr>
                <tr><th class="bg-light">Company</th><td>{{ $client->company ?? '-' }}</td></tr>
                <tr><th class="bg-light">Address</th><td>{{ $client->address ?? '-' }}</td></tr>
                <tr><th class="bg-light">Created By</th><td>{{ $client->creator->name }}</td></tr>
                <tr><th class="bg-light">Created At</th><td>{{ $client->created_at->format('Y-m-d H:i:s') }}</td></tr>
            </table>
        </div>
    </div>
</div>
@endsection