@extends('layouts.app')

@section('title', 'Tool Result')

@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Result for {{ $tool }} - {{ $target }}</h3>
    <div class="card">
        <div class="card-body">
            <pre>{{ $output }}</pre>
        </div>
    </div>
    <a href="{{ route('tools.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection