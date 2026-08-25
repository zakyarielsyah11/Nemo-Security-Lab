@extends('layouts.app')

@section('title', 'View File Content')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-book"></i> Viewing: {{ $file->original_name }}
                    </h5>
                    <div>
                        <a href="{{ route('files.show', $file) }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <a href="{{ route('files.download', $file) }}" class="btn btn-success btn-sm">
                            <i class="bi bi-download"></i> Download
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>File Info:</strong><br>
                        <span class="text-muted">
                            Type: {{ $file->mime_type }}<br>
                            Size: {{ number_format($file->file_size / 1024, 2) }} KB<br>
                            Uploaded: {{ $file->created_at->format('Y-m-d H:i:s') }}
                        </span>
                    </div>
                    
                    <hr>
                    
                    <div class="bg-light p-3" style="max-height: 600px; overflow-y: auto; border-radius: 5px;">
                        <pre class="mb-0" style="white-space: pre-wrap; word-wrap: break-word;">{{ $content }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection