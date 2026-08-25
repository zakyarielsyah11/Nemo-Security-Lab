@extends('layouts.app')

@section('title', 'Employees')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1"><i class="bi bi-person-badge"></i> Employees</h3>
            <p class="text-muted mb-0">Manage team members</p>
        </div>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> New Employee
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('employees.index') }}" class="mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search employees..." value="{{ request('search') }}">
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td><a href="{{ route('employees.show', $employee->id) }}">{{ $employee->name }}</a></td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->department ?? '-' }}</td>
                            <td>{{ $employee->position ?? '-' }}</td>
                            <td>{{ $employee->phone ?? '-' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Sure?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted">No employees found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($employees instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $employees->links() }}
            @endif
        </div>
    </div>
</div>
@endsection