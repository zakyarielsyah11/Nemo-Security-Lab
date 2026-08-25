@extends('layouts.app')

@section('title', 'Vulnerability Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>{{ $vuln->name }}</h3>
        <div>
            <a href="{{ route('vulndb.edit', $vuln->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
            <a href="{{ route('vulndb.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th class="bg-light">ID</th><td>{{ $vuln->id }}</td></tr>
                <tr><th class="bg-light">Name</th><td>{{ $vuln->name }}</td></tr>
                <tr><th class="bg-light">Severity</th><td>{{ $vuln->severity }}</td></tr>
                <tr><th class="bg-light">Category</th><td>{{ $vuln->category ?? '-' }}</td></tr>
                <tr><th class="bg-light">Description</th><td>{{ $vuln->description ?? '-' }}</td></tr>
                <tr><th class="bg-light">Remediation</th><td>{{ $vuln->remediation ?? '-' }}</td></tr>
            </table>
        </div>
    </div>
</div>
@endsection