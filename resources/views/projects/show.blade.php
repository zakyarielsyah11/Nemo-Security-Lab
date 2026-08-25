@extends('layouts.app')

@section('title', 'Project Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>{{ $project->name }}</h3>
        <div>
            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Details</h5>
                    <p><strong>Client:</strong> {{ $project->client_name ?? '-' }}</p>
                    <p><strong>Status:</strong> {{ $project->status }}</p>
                    <p><strong>Start:</strong> {{ $project->start_date ?? '-' }}</p>
                    <p><strong>End:</strong> {{ $project->end_date ?? '-' }}</p>
                    <p><strong>Created By:</strong> {{ $project->creator->name }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-chat"></i> Comments</h6>
                </div>
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    @foreach($project->comments as $comment)
                        <div class="border-bottom mb-2 pb-2">
                            <strong>{{ $comment->user->name }}</strong>
                            <!-- Stored XSS: {!! !!} sengaja tidak di-escape -->
                            <div>{!! $comment->comment !!}</div>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('projects.comments.store', $project->id) }}">
                        @csrf
                        <div class="input-group">
                            <textarea name="comment" class="form-control" placeholder="Add a comment..." rows="2"></textarea>
                            <button class="btn btn-primary" type="submit"><i class="bi bi-send"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection