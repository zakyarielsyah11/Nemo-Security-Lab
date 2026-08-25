@extends('layouts.app')

@section('title', 'File Details')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">File Details</h4>
                    <div>
                        <a href="{{ route('files.index') }}" class="btn btn-secondary btn-sm">Back</a>
                        <a href="{{ route('files.download', $file) }}" class="btn btn-success btn-sm">Download</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="200">ID:</th>
                            <td>{{ $file->id }}</td>
                        </tr>
                        <tr>
                            <th>Original Name:</th>
                            <td>{{ $file->original_name }}</td>
                        </tr>
                        <tr>
                            <th>Stored Name:</th>
                            <td>{{ $file->stored_name }}</td>
                        </tr>
                        <tr>
                            <th>MIME Type:</th>
                            <td>{{ $file->mime_type }}</td>
                        </tr>
                        <tr>
                            <th>File Size:</th>
                            <td>{{ number_format($file->file_size / 1024, 2) }} KB</td>
                        </tr>
                        <tr>
                            <th>Uploaded By:</th>
                            <td>{{ $file->uploader->name }} ({{ $file->uploader->email }})</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $file->description ?: 'No description' }}</td>
                        </tr>
                        <tr>
                            <th>Uploaded At:</th>
                            <td>{{ $file->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </table>

                    @if($file->isTextFile())
                        <a href="{{ route('files.view', $file) }}" class="btn btn-primary">View Content</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection