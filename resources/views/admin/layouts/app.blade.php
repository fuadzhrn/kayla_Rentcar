<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Kalya Rentcar Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome 6.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AdminLTE 3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">

    <!-- Chart.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #FFD700;
            --secondary-color: #1a1a1a;
        }

        .navbar-dark .navbar-brand {
            color: #fff !important;
            font-weight: 700;
            font-size: 1.25rem;
        }

        .brand-text {
            color: #FFD700;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active,
        .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
            background-color: #FFD700;
            color: #1a1a1a;
            border-left-color: #FFD700;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:hover {
            background-color: rgba(255, 215, 0, 0.1);
        }

        .main-header.navbar {
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            border-bottom: 2px solid #FFD700;
        }

        .main-sidebar {
            background: linear-gradient(180deg, #1a1a1a 0%, #0d0d0d 100%);
        }

        .content-wrapper {
            background-color: #f5f5f5;
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background-color: #FFD700;
            border-color: #FFD700;
            color: #1a1a1a;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #FFC700;
            border-color: #FFC700;
            color: #1a1a1a;
        }

        .badge-primary {
            background-color: #FFD700;
            color: #1a1a1a;
        }

        .small-box.bg-info {
            background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%) !important;
            color: #1a1a1a !important;
        }

        .small-box.bg-info .inner p {
            color: #1a1a1a;
        }

        .small-box.bg-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
        }

        .small-box.bg-warning {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%) !important;
        }

        .small-box.bg-danger {
            background: linear-gradient(135deg, #dc3545 0%, #e74c3c 100%) !important;
        }
    </style>

    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- User Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog mr-2"></i>
                            <span>Settings</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('auth.logout') }}" class="dropdown-item"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <i class="fas fa-car" style="color: #FFD700;"></i>
                <span class="brand-text font-weight-bold"><span class="brand-text">Kalya</span> Rentcar</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif">
                                <i class="nav-icon fas fa-th-large"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Vehicles Management -->
                        <li class="nav-item @if(request()->routeIs('admin.vehicles.*')) menu-open @endif">
                            <a href="#" class="nav-link @if(request()->routeIs('admin.vehicles.*')) active @endif">
                                <i class="nav-icon fas fa-car"></i>
                                <p>
                                    Manajemen Kendaraan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.vehicles.index') }}" class="nav-link @if(request()->routeIs('admin.vehicles.index')) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Kendaraan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.vehicles.create') }}" class="nav-link @if(request()->routeIs('admin.vehicles.create')) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Kendaraan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Gallery Management -->
                        <li class="nav-item">
                            <a href="{{ route('admin.gallery.index') }}" class="nav-link @if(request()->routeIs('admin.gallery.*')) active @endif">
                                <i class="nav-icon fas fa-images"></i>
                                <p>Galeri Foto</p>
                            </a>
                        </li>

                        <!-- Rental Types Management -->
                        <li class="nav-item">
                            <a href="{{ route('admin.rental-types.index') }}" class="nav-link @if(request()->routeIs('admin.rental-types.*')) active @endif">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Jenis Layanan</p>
                            </a>
                        </li>

                        <!-- Settings -->
                        <li class="nav-item">
                            <a href="{{ route('admin.settings') }}" class="nav-link @if(request()->routeIs('admin.settings')) active @endif">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Pengaturan</p>
                            </a>
                        </li>

                        <li class="nav-header">LAINNYA</li>

                        <!-- Back to Home -->
                        <li class="nav-item">
                            <a href="/" class="nav-link" target="_blank">
                                <i class="nav-icon fas fa-arrow-left"></i>
                                <p>Kembali ke Beranda</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page-title', 'Dashboard')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">@yield('breadcrumb')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Kalya Rentcar &copy; 2026</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    @stack('scripts')
</body>
</html>
