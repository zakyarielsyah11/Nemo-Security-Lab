@extends('layouts.app')

@section('title', 'Files')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Files</h2>
        <a href="{{ route('files.upload') }}" class="btn btn-primary">Upload File</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Filename</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Uploaded By</th>
                            <th>Uploaded At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                            <tr>
                                <td>{{ $file->id }}</td>
                                <td>{{ $file->original_name }}</td>
                                <td>{{ $file->mime_type }}</td>
                                <td>{{ number_format($file->file_size / 1024, 2) }} KB</td>
                                <td>{{ $file->uploader->name }}</td>
                                <td>{{ $file->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <a href="{{ route('files.show', $file) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('files.download', $file) }}" class="btn btn-sm btn-success">Download</a>
                                    @if($file->isTextFile())
                                        <a href="{{ route('files.view', $file) }}" class="btn btn-sm btn-primary">Read</a>
                                    @endif
                                    <form action="{{ route('files.destroy', $file) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $files->links() }}
            </div>
        </div>
    </div>
</div>
@endsection