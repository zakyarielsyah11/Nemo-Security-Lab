@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>{{ $employee->name }}</h3>
        <div>
            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th class="bg-light">ID</th><td>{{ $employee->id }}</td></tr>
                <tr><th class="bg-light">Name</th><td>{{ $employee->name }}</td></tr>
                <tr><th class="bg-light">Email</th><td>{{ $employee->email }}</td></tr>
                <tr><th class="bg-light">Department</th><td>{{ $employee->department ?? '-' }}</td></tr>
                <tr><th class="bg-light">Position</th><td>{{ $employee->position ?? '-' }}</td></tr>
                <tr><th class="bg-light">Phone</th><td>{{ $employee->phone ?? '-' }}</td></tr>
            </table>
        </div>
    </div>
</div>
@endsection