@extends('admin.layouts.app')

@section('title', 'Detail Pemesanan')
@section('page-title', 'Detail Pemesanan #' . $booking->id)
@section('breadcrumb', 'Detail Pemesanan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Informasi Pemesanan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold mb-3">Data Pemesanan</h6>
                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bold" width="40%">ID Pemesanan</td>
                                <td>#{{ $booking->id }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Pemesanan</td>
                                <td>{{ $booking->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status</td>
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
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="font-weight-bold mb-3">Data Pelanggan</h6>
                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bold" width="40%">Nama</td>
                                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Email</td>
                                <td>{{ $booking->user->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Telepon</td>
                                <td>{{ $booking->user->phone ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Detail Kendaraan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        @if($booking->vehicle->image)
                            <img src="{{ asset('storage/' . $booking->vehicle->image) }}" class="img-fluid rounded" style="max-height: 150px; object-fit: cover;">
                        @else
                            <i class="fas fa-car fa-5x text-muted"></i>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h5>{{ $booking->vehicle->name ?? 'N/A' }}</h5>
                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bold" width="30%">Brand</td>
                                <td>{{ $booking->vehicle->brand ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tipe</td>
                                <td>{{ $booking->vehicle->vehicle_type ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Transmisi</td>
                                <td>{{ $booking->vehicle->transmission ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Periode Sewa</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="font-weight-bold">Tanggal Mulai</h6>
                        <p>{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="font-weight-bold">Tanggal Selesai</h6>
                        <p>{{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="font-weight-bold">Durasi Sewa</h6>
                        <p>{{ \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date)) }} Hari</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Ringkasan Biaya</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td>Harga per Hari</td>
                        <td class="text-right font-weight-bold">Rp {{ number_format($booking->vehicle->price_per_day ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Durasi (Hari)</td>
                        <td class="text-right font-weight-bold">{{ \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date)) }}</td>
                    </tr>
                    <tr class="border-top">
                        <td class="font-weight-bold">Total</td>
                        <td class="text-right font-weight-bold">
                            <span style="color: #FFD700; font-size: 1.1em;">
                                Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Aksi</h3>
            </div>
            <div class="card-body">
                @if($booking->status == 'pending')
                    <form action="{{ route('admin.bookings.confirm', $booking->id) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-check"></i> Konfirmasi Pemesanan
                        </button>
                    </form>
                @endif

                @if($booking->status != 'cancelled')
                    <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Batalkan pemesanan ini?');">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-times"></i> Batalkan
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
