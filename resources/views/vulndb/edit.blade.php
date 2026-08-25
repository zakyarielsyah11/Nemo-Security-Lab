@extends('layouts.app')

@section('title', 'Edit Vulnerability')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit Vulnerability #{{ $vuln->id }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('vulndb.update', $vuln->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $vuln->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $vuln->description }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Severity</label>
                                <select name="severity" class="form-control">
                                    <option value="low" {{ $vuln->severity == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $vuln->severity == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ $vuln->severity == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="critical" {{ $vuln->severity == 'critical' ? 'selected' : '' }}>Critical</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" class="form-control" value="{{ $vuln->category }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Remediation</label>
                            <textarea name="remediation" class="form-control" rows="3">{{ $vuln->remediation }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('vulndb.show', $vuln->id) }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection