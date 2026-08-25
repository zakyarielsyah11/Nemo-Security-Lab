<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nemo Security Lab')</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='%232563eb' d='M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 6.5-4 4a.5.5 0 0 1-.7 0l-2-2a.5.5 0 0 1 .7-.7l1.65 1.65 3.65-3.65a.5.5 0 0 1 .7.7z'/%3E%3C/svg%3E">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #0d6efd;
            --navy: #0a1e3c;
            --navy-light: #10315e;
            --accent: #3b82f6;
            --sidebar-bg: #0f2a4a;
            --sidebar-hover: #1e3a5f;
            --text-light: #e0e7ff;
        }

        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, #0a1e3c 0%, #10315e 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        }

        .navbar-brand {
            font-weight: 700;
            color: #ffffff !important;
            letter-spacing: 0.5px;
        }
        .navbar-brand i {
            color: #60a5fa;
        }

        .navbar .nav-link {
            color: #cbd5e1 !important;
        }
        .navbar .nav-link:hover {
            color: #ffffff !important;
        }
        .navbar .dropdown-menu {
            background-color: #ffffff;
            border: none;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .sidebar {
            min-height: calc(100vh - 56px);
            background: linear-gradient(180deg, #0f2a4a 0%, #0a1e3c 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #cbd5e1;
            padding: 10px 20px;
            border-radius: 8px;
            margin: 3px 12px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            color: #60a5fa;
        }
        .sidebar .nav-link:hover {
            background-color: #1e3a5f;
            color: #ffffff;
        }
        .sidebar .nav-link.active {
            background-color: #2563eb;
            color: #ffffff;
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.3);
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: box-shadow 0.2s;
        }
        .card:hover {
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            border-radius: 12px 12px 0 0;
        }

        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        .table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
        }
        .table td {
            vertical-align: middle;
        }

        .badge-soft-success {
            background-color: #dcfce7;
            color: #16a34a;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .badge-soft-warning {
            background-color: #fef9c3;
            color: #ca8a04;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .badge-soft-danger {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .main-content {
            padding: 24px;
        }

        .stat-card {
            border-radius: 12px;
            color: #fff;
            border: none;
        }
        .stat-card .card-body {
            padding: 1.5rem;
        }
        .stat-card i {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        .bg-primary-soft {
            background: linear-gradient(135deg, #2563eb, #1e40af);
        }
        .bg-success-soft {
            background: linear-gradient(135deg, #16a34a, #15803d);
        }
        .bg-warning-soft {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }
        .bg-info-soft {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">
                <i class="bi bi-shield-lock-fill"></i> Nemo Security Lab
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            {{ auth()->user()->name }}
                            @if(auth()->user()->role === 'admin')
                                <span class="badge bg-danger ms-1">Admin</span>
                            @else
                                <span class="badge bg-info ms-1">User</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/profile"><i class="bi bi-person"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar d-none d-md-block">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="/products">
                            <i class="bi bi-box-seam"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('projects*') ? 'active' : '' }}" href="/projects">
                            <i class="bi bi-kanban"></i> Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('clients*') ? 'active' : '' }}" href="/clients">
                            <i class="bi bi-people"></i> Clients
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('employees*') ? 'active' : '' }}" href="/employees">
                            <i class="bi bi-person-badge"></i> Employees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('vulndb*') ? 'active' : '' }}" href="/vulndb">
                            <i class="bi bi-bug"></i> Vuln DB
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tools*') ? 'active' : '' }}" href="/tools">
                            <i class="bi bi-terminal"></i> Network Tools
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('files*') ? 'active' : '' }}" href="/files">
                            <i class="bi bi-folder2-open"></i> Files
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('import*') ? 'active' : '' }}" href="/import">
                            <i class="bi bi-upload"></i> Import Data
                        </a>
                    </li>
                    @if(auth()->user()->role === 'admin')
                    <hr class="text-light">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="/admin/dashboard">
                            <i class="bi bi-shield-check"></i> Admin Panel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="/admin/users">
                            <i class="bi bi-people"></i> User Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/files*') ? 'active' : '' }}" href="/admin/files">
                            <i class="bi bi-folder-check"></i> File Management
                        </a>
                    </li>
                    @endif
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.classList.remove('show');
            });
        }, 5000);
    </script>
    @yield('scripts')
</body>
</html>