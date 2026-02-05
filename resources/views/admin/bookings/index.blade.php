@extends('admin.layouts.app')

@section('title', 'Pemesanan')
@section('page-title', 'Manajemen Pemesanan')
@section('breadcrumb', 'Pemesanan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Daftar Pemesanan</h3>
            </div>
            <div class="card-body">
                @if($bookings->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Tidak ada pemesanan.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="bookingsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pelanggan</th>
                                    <th>Kendaraan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                    <tr>
                                        <td>#{{ $booking->id }}</td>
                                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                        <td>{{ $booking->vehicle->name ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif($booking->status == 'confirmed')
                                                <span class="badge badge-success">Dikonfirmasi</span>
                                            @elseif($booking->status == 'completed')
                                                <span class="badge badge-primary">Selesai</span>
                                            @else
                                                <span class="badge badge-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
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
        $('#bookingsTable').DataTable({
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
