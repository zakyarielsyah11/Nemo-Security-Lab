@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1"><i class="bi bi-kanban"></i> Projects</h3>
            <p class="text-muted mb-0">Manage security assessment projects</p>
        </div>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> New Project
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('projects.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search projects..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></td>
                            <td>{{ $project->client_name ?? '-' }}</td>
                            <td><span class="badge bg-{{ $project->status == 'active' ? 'success' : 'secondary' }}">{{ $project->status }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($project->created_at)->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sure?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted">No projects found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($projects instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $projects->links() }}
            @endif
        </div>
    </div>
</div>
@endsection