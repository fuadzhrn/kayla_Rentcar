@extends('admin.layouts.app')

@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Sistem')
@section('breadcrumb', 'Pengaturan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Informasi Sistem</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bold" width="40%">Nama Aplikasi</td>
                                <td>Kalya Rentcar</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Versi</td>
                                <td>1.0.0</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Framework</td>
                                <td>Laravel 11</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Database</td>
                                <td>MySQL</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bold" width="40%">Template</td>
                                <td>AdminLTE 3</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">PHP Version</td>
                                <td>{{ phpversion() }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Server</td>
                                <td>{{ $_SERVER['SERVER_SOFTWARE'] ?? 'Apache' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal</td>
                                <td>{{ now()->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Tentang Kalya Rentcar</h3>
            </div>
            <div class="card-body">
                <p>
                    Kalya Rentcar adalah platform manajemen rental kendaraan yang dirancang untuk memudahkan 
                    pengelolaan armada kendaraan dan galeri foto secara profesional.
                </p>
                <hr>
                <h5>Fitur Utama:</h5>
                <ul>
                    <li>Manajemen Kendaraan (CRUD)</li>
                    <li>Manajemen Galeri Foto</li>
                    <li>Dashboard Analytics</li>
                    <li>Manajemen User</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Statistik Cepat</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6>Total Kendaraan</h6>
                    <p class="text-primary" style="font-size: 1.5em; color: #FFD700;">
                        <i class="fas fa-car"></i> {{ \App\Models\Vehicle::count() }}
                    </p>
                </div>
                <div class="mb-3">
                    <h6>Total Foto Galeri</h6>
                    <p class="text-success" style="font-size: 1.5em;">
                        <i class="fas fa-image"></i> {{ \App\Models\Gallery::count() }}
                    </p>
                </div>
                <div class="mb-3">
                    <h6>Total Admin</h6>
                    <p class="text-info" style="font-size: 1.5em;">
                        <i class="fas fa-users"></i> {{ \App\Models\User::count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Aksi Cepat</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary btn-block mb-2">
                    <i class="fas fa-plus"></i> Tambah Kendaraan
                </a>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-info btn-block mb-2">
                    <i class="fas fa-upload"></i> Upload Foto
                </a>
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary btn-block">
                    <i class="fas fa-list"></i> Lihat Semua
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Support</h3>
            </div>
            <div class="card-body">
                <p class="small">
                    Untuk dukungan teknis atau pertanyaan, silakan hubungi administrator sistem.
                </p>
                <p class="small mb-0">
                    <strong>Email:</strong> admin@kalyarentcar.com
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
