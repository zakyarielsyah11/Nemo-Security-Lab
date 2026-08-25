@extends('layouts.app')

@section('title', 'Vulnerability Database')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1"><i class="bi bi-bug"></i> Vulnerability Database</h3>
            <p class="text-muted mb-0">Reference of known vulnerabilities</p>
        </div>
        <a href="{{ route('vulndb.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> New Entry
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('vulndb.index') }}" class="mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search vulnerabilities..." value="{{ request('search') }}">
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Severity</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vulns as $vuln)
                        <tr>
                            <td>{{ $vuln->id }}</td>
                            <td><a href="{{ route('vulndb.show', $vuln->id) }}">{{ $vuln->name }}</a></td>
                            <td>{{ $vuln->category ?? '-' }}</td>
                            <td><span class="badge bg-{{ $vuln->severity == 'critical' ? 'danger' : ($vuln->severity == 'high' ? 'warning' : 'info') }}">{{ $vuln->severity }}</span></td>
                            <td>{{ $vuln->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('vulndb.edit', $vuln->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('vulndb.destroy', $vuln->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Sure?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted">No vulnerabilities found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($vulns instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $vulns->links() }}
            @endif
        </div>
    </div>
</div>
@endsection