@extends('layouts.app')

@section('title', 'Files')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1"><i class="bi bi-folder2-open"></i> Files</h3>
            <p class="text-muted mb-0">Manage documents and imported files</p>
        </div>
        <div>
            <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#importUrlModal">
                <i class="bi bi-link"></i> Import from URL
            </button>
            <a href="{{ route('files.upload') }}" class="btn btn-primary">
                <i class="bi bi-upload"></i> Upload File
            </a>
        </div>
    </div>

    <!-- Modal Import URL -->
    <div class="modal fade" id="importUrlModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('files.import-url') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Import File from URL</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">File URL</label>
                            <input type="url" name="file_url" class="form-control" placeholder="https://example.com/file.txt" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" placeholder="Optional">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_public" id="is_public">
                            <label class="form-check-label" for="is_public">Make this file public</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('files.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search files..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Filename</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Uploaded By</th>
                            <th>Uploaded At</th>
                            <th>Public</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($files as $file)
                        <tr>
                            <td>{{ $file->id }}</td>
                            <td><i class="bi bi-file-earmark"></i> {{ $file->original_name }}</td>
                            <td><span class="badge bg-secondary">{{ $file->mime_type }}</span></td>
                            <td>{{ number_format($file->file_size / 1024, 2) }} KB</td>
                            <td>{{ $file->uploader->name }}</td>
                            <td>{{ $file->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                @if($file->is_public)
                                    <span class="badge bg-success">Public</span>
                                @else
                                    <span class="badge bg-warning">Private</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('files.show', $file) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('files.download', $file) }}" class="btn btn-sm btn-success"><i class="bi bi-download"></i></a>
                                    @if($file->isTextFile())
                                        <a href="{{ route('files.view', $file) }}" class="btn btn-sm btn-primary"><i class="bi bi-book"></i></a>
                                    @endif
                                    <form action="{{ route('files.destroy', $file) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center text-muted">No files found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($files instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $files->links() }}
            @endif
        </div>
    </div>
</div>
@endsection