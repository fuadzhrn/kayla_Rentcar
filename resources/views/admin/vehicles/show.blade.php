@extends('admin.layouts.app')

@section('title', $vehicle->name)
@section('page-title', $vehicle->name)
@section('breadcrumb', 'Detail Kendaraan')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                @if($vehicle->images()->where('is_primary', true)->count() > 0)
                    <img src="{{ $vehicle->primary_image }}" class="img-fluid rounded mb-3" style="max-height: 250px; object-fit: cover;" alt="{{ $vehicle->name }}" onerror="this.src='/img/gambar_bg.png'">
                @else
                    <div class="bg-light p-5 rounded mb-3">
                        <i class="fas fa-car fa-3x text-muted"></i>
                    </div>
                @endif
                <h5>{{ $vehicle->name }}</h5>
                <p class="text-muted">{{ $vehicle->brand }} - {{ $vehicle->model }}</p>
                <div class="badge badge-lg" style="background-color: #FFD700; color: #1a1a1a;">
                    <h4 class="mb-0">Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}/Hari</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header with-border">
                <h5 class="card-title">Status</h5>
            </div>
            <div class="card-body">
                @if($vehicle->is_available)
                    <span class="badge badge-success badge-lg">Tersedia</span>
                @else
                    <span class="badge badge-danger badge-lg">Tidak Tersedia</span>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header with-border">
                <h5 class="card-title">Aksi</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-warning btn-block mb-2">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.gallery.index', ['vehicle_id' => $vehicle->id]) }}" class="btn btn-info btn-block mb-2">
                    <i class="fas fa-images"></i> Galeri Foto
                </a>
                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Hapus kendaraan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-block">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <!-- Spesifikasi -->
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Spesifikasi Teknis</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bold">Tahun</td>
                                <td>{{ $vehicle->year }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tipe Kendaraan</td>
                                <td>{{ $vehicle->vehicle_type }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Transmisi</td>
                                <td>{{ $vehicle->transmission }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Engine CC</td>
                                <td>{{ $vehicle->engine_cc }} cc</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bold">Tipe Bahan Bakar</td>
                                <td>{{ $vehicle->fuel_type }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Kapasitas Penumpang</td>
                                <td>{{ $vehicle->seat_capacity }} Orang</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Dibuat</td>
                                <td>{{ $vehicle->created_at->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Diupdate</td>
                                <td>{{ $vehicle->updated_at->format('d M Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Harga -->
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Informasi Harga</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td class="font-weight-bold">Per Hari</td>
                        <td>Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Per Minggu</td>
                        <td>Rp {{ number_format($vehicle->price_per_week ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Per Bulan</td>
                        <td>Rp {{ number_format($vehicle->price_per_month ?? 0, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Deskripsi -->
        @if($vehicle->description)
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title">Deskripsi</h3>
                </div>
                <div class="card-body">
                    {{ $vehicle->description }}
                </div>
            </div>
        @endif

        <!-- Fitur Kendaraan -->
        @if($vehicle->features->count() > 0)
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title">Fitur & Fasilitas</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($vehicle->features as $feature)
                            <div class="col-md-4 mb-2">
                                <i class="fas fa-check-circle text-success"></i> {{ $feature->feature_name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
