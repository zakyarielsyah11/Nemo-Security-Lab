@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-box"></i> Product Details</h5>
                    <div>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="bg-light">ID</th>
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">SKU</th>
                                    <td>{{ $product->sku ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Title</th>
                                    <td>{{ $product->title }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Category</th>
                                    <td>{{ $product->category ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="bg-light">Price</th>
                                    <td>Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Stock</th>
                                    <td>{{ $product->stock ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Status</th>
                                    <td>
                                        <span class="badge badge-{{ $product->status }}">
                                            {{ $product->status }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Created By</th>
                                    <td>{{ $product->creator->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <h6 class="fw-bold">Description:</h6>
                        <p class="text-muted">{{ $product->description ?: 'No description' }}</p>
                    </div>
                    
                    <div class="mt-3">
                        <h6 class="fw-bold">Timestamps:</h6>
                        <p class="text-muted small">
                            Created: {{ $product->created_at->format('Y-m-d H:i:s') }}<br>
                            Updated: {{ $product->updated_at->format('Y-m-d H:i:s') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection