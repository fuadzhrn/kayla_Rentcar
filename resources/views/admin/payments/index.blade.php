@extends('admin.layouts.app')

@section('title', 'Pembayaran')
@section('page-title', 'Manajemen Pembayaran')
@section('breadcrumb', 'Pembayaran')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Daftar Pembayaran</h3>
            </div>
            <div class="card-body">
                @if($payments->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Tidak ada pembayaran.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="paymentsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pemesanan</th>
                                    <th>Pelanggan</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $payment)
                                    <tr>
                                        <td>#{{ $payment->id }}</td>
                                        <td>#{{ $payment->booking->id ?? 'N/A' }}</td>
                                        <td>{{ $payment->booking->user->name ?? 'N/A' }}</td>
                                        <td>
                                            <strong>Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong>
                                        </td>
                                        <td>
                                            @if($payment->payment_method == 'transfer')
                                                <span class="badge badge-info">Transfer Bank</span>
                                            @elseif($payment->payment_method == 'cash')
                                                <span class="badge badge-primary">Tunai</span>
                                            @else
                                                <span class="badge badge-secondary">{{ ucfirst($payment->payment_method) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $payment->created_at->format('d M Y H:i') }}</td>
                                        <td>
                                            @if($payment->status == 'completed')
                                                <span class="badge badge-success">Lunas</span>
                                            @elseif($payment->status == 'pending')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @else
                                                <span class="badge badge-danger">Gagal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-sm btn-info">
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
        $('#paymentsTable').DataTable({
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
