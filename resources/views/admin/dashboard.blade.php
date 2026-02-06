@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="row">
    <!-- Total Vehicles -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalVehicles ?? 0 }}</h3>
                <p>Total Kendaraan</p>
            </div>
            <div class="icon">
                <i class="fas fa-car"></i>
            </div>
            <a href="{{ route('admin.vehicles.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Images -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalImages ?? 0 }}</h3>
                <p>Total Foto Galeri</p>
            </div>
            <div class="icon">
                <i class="fas fa-images"></i>
            </div>
            <a href="{{ route('admin.gallery.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Rental Types -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalRentalTypes ?? 0 }}</h3>
                <p>Total Jenis Layanan</p>
            </div>
            <div class="icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <a href="{{ route('admin.rental-types.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Vehicles Available -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $availableVehicles ?? 0 }}</h3>
                <p>Kendaraan Tersedia</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="{{ route('admin.vehicles.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

<div class="row">
    <!-- Recent Vehicles -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Kendaraan Terbaru</h3>
                <div class="card-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Transmisi</th>
                                <th>Harga/Hari</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentVehicles ?? [] as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->name }}</td>
                                    <td>{{ $vehicle->transmission }}</td>
                                    <td>Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}</td>
                                    <td>
                                        @if($vehicle->is_available)
                                            <span class="badge badge-success">Tersedia</span>
                                        @else
                                            <span class="badge badge-danger">Tidak</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Tidak ada kendaraan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Stats -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Statistik Galeri Foto</h3>
                <div class="card-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center">
                            <h3 style="color: #FFD700;">{{ $totalImages ?? 0 }}</h3>
                            <p>Total Foto</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center">
                            <h3 style="color: #28a745;">{{ $vehiclesWithImages ?? 0 }}</h3>
                            <p>Kendaraan dengan Foto</p>
                        </div>
                    </div>
                </div>
                <hr>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-block btn-sm">
                    <i class="fas fa-upload"></i> Upload Foto
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Quick Actions -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Aksi Cepat</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kendaraan
                </a>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-info">
                    <i class="fas fa-upload"></i> Upload Foto
                </a>
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> Lihat Semua Kendaraan
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                    <i class="fas fa-images"></i> Kelola Galeri
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
