@extends('layouts.app')

@section('title', 'Import Result')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="mb-1"><i class="bi bi-check-circle"></i> Import Results</h3>
        <p class="text-muted mb-0">Summary of import operation</p>
    </div>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle" style="font-size: 40px;"></i>
                    <h5 class="mt-2">Success</h5>
                    <h2>{{ $successCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body text-center">
                    <i class="bi bi-x-circle" style="font-size: 40px;"></i>
                    <h5 class="mt-2">Failed</h5>
                    <h2>{{ $failedCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    @if(isset($preview) && count($preview) > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-check-circle"></i> Successfully Imported</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Row</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($preview as $item)
                                <tr>
                                    <td>{{ $item['row'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['email'] }}</td>
                                    <td><span class="badge bg-success">{{ $item['status'] }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    @if(isset($errors) && count($errors) > 0)
        <div class="card mt-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0"><i class="bi bi-exclamation-triangle"></i> Errors</h5>
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    @foreach($errors as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <a href="{{ route('import.index') }}" class="btn btn-primary mt-3">
        <i class="bi bi-arrow-left"></i> Back to Import
    </a>
</div>
@endsection