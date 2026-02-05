@extends('admin.layouts.app')

@section('title', 'Detail Pembayaran')
@section('page-title', 'Detail Pembayaran #' . $payment->id)
@section('breadcrumb', 'Detail Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Informasi Pembayaran</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bold" width="40%">ID Pembayaran</td>
                                <td>#{{ $payment->id }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">ID Pemesanan</td>
                                <td>#{{ $payment->booking->id ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Pembayaran</td>
                                <td>{{ $payment->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status</td>
                                <td>
                                    @if($payment->status == 'completed')
                                        <span class="badge badge-success badge-lg">Lunas</span>
                                    @elseif($payment->status == 'pending')
                                        <span class="badge badge-warning badge-lg">Menunggu</span>
                                    @else
                                        <span class="badge badge-danger badge-lg">Gagal</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bold" width="40%">Metode Pembayaran</td>
                                <td>
                                    @if($payment->payment_method == 'transfer')
                                        Transfer Bank
                                    @elseif($payment->payment_method == 'cash')
                                        Tunai
                                    @else
                                        {{ ucfirst($payment->payment_method) }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jumlah Pembayaran</td>
                                <td>
                                    <strong style="color: #FFD700; font-size: 1.1em;">
                                        Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Referensi</td>
                                <td>{{ $payment->reference_number ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Data Pelanggan</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td class="font-weight-bold" width="30%">Nama</td>
                        <td>{{ $payment->booking->user->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Email</td>
                        <td>{{ $payment->booking->user->email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Telepon</td>
                        <td>{{ $payment->booking->user->phone ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Detail Pemesanan</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td class="font-weight-bold" width="30%">Kendaraan</td>
                        <td>{{ $payment->booking->vehicle->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Periode Sewa</td>
                        <td>
                            {{ \Carbon\Carbon::parse($payment->booking->start_date)->format('d M Y') }} - 
                            {{ \Carbon\Carbon::parse($payment->booking->end_date)->format('d M Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Durasi</td>
                        <td>{{ \Carbon\Carbon::parse($payment->booking->start_date)->diffInDays(\Carbon\Carbon::parse($payment->booking->end_date)) }} Hari</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Total Pemesanan</td>
                        <td>Rp {{ number_format($payment->booking->total_price ?? 0, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Catatan</h3>
            </div>
            <div class="card-body">
                <p>{{ $payment->notes ?? 'Tidak ada catatan' }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Aksi</h3>
            </div>
            <div class="card-body">
                @if($payment->status == 'pending')
                    <form action="{{ route('admin.payments.confirm', $payment->id) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-check"></i> Konfirmasi Pembayaran
                        </button>
                    </form>
                @endif

                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary btn-block">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
