@extends('admin.layouts.app')

@section('title', 'Daftar Kendaraan')
@section('page-title', 'Daftar Kendaraan')
@section('breadcrumb', 'Kendaraan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Manajemen Kendaraan</h3>
                <div class="card-tools pull-right">
                    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Kendaraan
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($vehicles->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Tidak ada kendaraan. 
                        <a href="{{ route('admin.vehicles.create') }}">Tambah kendaraan sekarang</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="vehiclesTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Transmisi</th>
                                    <th>Penumpang</th>
                                    <th>Harga/Hari</th>
                                    <th>Bahan Bakar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vehicles as $key => $vehicle)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if($vehicle->images()->where('is_primary', true)->count() > 0)
                                                <img src="{{ $vehicle->primary_image }}" alt="{{ $vehicle->name }}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 5px;" onerror="this.src='/img/placeholder.png'">
                                            @else
                                                <div style="height: 60px; width: 60px; background-color: #ddd; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-image" style="color: #999; font-size: 24px;"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $vehicle->name }}</strong>
                                        </td>
                                        <td>{{ $vehicle->transmission }}</td>
                                        <td><span class="badge badge-primary">{{ $vehicle->seat_capacity }} Orang</span></td>
                                        <td>
                                            <strong>Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}</strong>
                                        </td>
                                        <td>{{ $vehicle->fuel_type }}</td>
                                        <td>
                                            @if($vehicle->is_available)
                                                <span class="badge badge-success">Tersedia</span>
                                            @else
                                                <span class="badge badge-danger">Tidak Tersedia</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" class="btn btn-info" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus kendaraan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#vehiclesTable').DataTable({
            "lengthChange": true,
            "pageLength": 10,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>
@endpush
@endsection
