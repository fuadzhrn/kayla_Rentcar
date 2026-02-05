@extends('admin.layouts.app')

@section('title', 'Jenis Layanan')
@section('page-title', 'Manajemen Jenis Layanan')
@section('breadcrumb', 'Jenis Layanan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Daftar Jenis Layanan Sewa</h3>
                <div class="card-tools pull-right">
                    <a href="{{ route('admin.rental-types.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Jenis Layanan
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($rentalTypes->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada jenis layanan. 
                        <a href="{{ route('admin.rental-types.create') }}">Tambahkan sekarang</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="5%">Icon</th>
                                    <th width="20%">Nama Layanan</th>
                                    <th width="50%">Deskripsi</th>
                                    <th width="10%">Order</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rentalTypes as $key => $type)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <i class="fas {{ $type->icon }}" style="font-size: 1.5em; color: #FFD700;"></i>
                                        </td>
                                        <td>
                                            <strong>{{ $type->name }}</strong>
                                        </td>
                                        <td>
                                            {{ substr($type->description, 0, 60) }}{{ strlen($type->description) > 60 ? '...' : '' }}
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $type->order }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.rental-types.edit', $type->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('admin.rental-types.destroy', $type->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus jenis layanan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            <i class="fas fa-inbox"></i> Tidak ada data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $rentalTypes->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Info Box -->
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">
                <i class="fas fa-lightbulb"></i> Tips
            </h4>
            <p class="mb-0">
                Kelola jenis-jenis layanan yang tersedia. Setiap jenis layanan akan ditampilkan di halaman public. 
                Gunakan field "Order" untuk mengatur urutan tampilan di halaman publik.
            </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
@endsection
