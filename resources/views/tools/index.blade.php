@extends('layouts.app')

@section('title', 'Network Tools')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4"><i class="bi bi-terminal"></i> Network Tools</h3>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-hdd-network"></i> Ping</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tools.ping') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="target" class="form-control" placeholder="IP address or domain">
                            <button type="submit" class="btn btn-primary">Ping</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-diagram-3"></i> Traceroute</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tools.traceroute') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="target" class="form-control" placeholder="IP address or domain">
                            <button type="submit" class="btn btn-primary">Traceroute</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection