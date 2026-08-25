@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Welcome back, {{ auth()->user()->name }}!</h3>
            <p class="text-muted mb-0">
                @if(auth()->user()->position)
                    {{ auth()->user()->position }} - {{ auth()->user()->department }}
                @else
                    Member
                @endif
            </p>
        </div>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> New Product
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card stat-card bg-primary-soft text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Products</h6>
                            <h2 class="mt-2 mb-0">{{ $totalProducts }}</h2>
                        </div>
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-success-soft text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Files</h6>
                            <h2 class="mt-2 mb-0">{{ $totalFiles }}</h2>
                        </div>
                        <i class="bi bi-folder2-open"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-warning-soft text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Activities</h6>
                            <h2 class="mt-2 mb-0">{{ $totalActivities }}</h2>
                        </div>
                        <i class="bi bi-activity"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-info-soft text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Role</h6>
                            <h2 class="mt-2 mb-0">{{ ucfirst(auth()->user()->role) }}</h2>
                        </div>
                        <i class="bi bi-person-badge"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"><i class="bi bi-box-seam"></i> Recent Products</h6>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($recentProducts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentProducts as $product)
                                        <tr>
                                            <td>
                                                <a href="{{ route('products.show', $product) }}">
                                                    {{ $product->title }}
                                                </a>
                                            </td>
                                            <td>{{ $product->category }}</td>
                                            <td>
                                                <span class="badge badge-{{ $product->status }}">
                                                    {{ $product->status }}
                                                </span>
                                            </td>
                                            <td>{{ $product->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center py-3">
                            <i class="bi bi-inbox" style="font-size: 40px;"></i><br>
                            No products yet.
                            <a href="{{ route('products.create') }}">Create one</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-activity"></i> Recent Activities</h6>
                </div>
                <div class="card-body">
                    @if($recentActivities->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($recentActivities as $activity)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $activity->action }}</strong><br>
                                        <small class="text-muted">{{ $activity->details }}</small>
                                    </div>
                                    <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted text-center py-3">No activities yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection