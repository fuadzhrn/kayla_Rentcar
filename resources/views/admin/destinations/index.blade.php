@extends('admin.layouts.app')

@section('title', 'Tujuan Perjalanan')
@section('page-title', 'Tujuan Perjalanan')
@section('breadcrumb', 'Tujuan Perjalanan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Manajemen Tujuan Perjalanan</h3>
                <div class="card-tools pull-right">
                    <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Tujuan
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($destinations->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Tidak ada tujuan perjalanan. 
                        <a href="{{ route('admin.destinations.create') }}">Tambah tujuan sekarang</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="40%">Nama Tujuan</th>
                                    <th width="25%">Biaya Tambahan/Hari</th>
                                    <th width="15%">Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($destinations as $key => $destination)
                                    <tr>
                                        <td>{{ ($destinations->currentPage() - 1) * $destinations->perPage() + $key + 1 }}</td>
                                        <td>
                                            <strong>{{ $destination->name }}</strong>
                                        </td>
                                        <td>
                                            <strong style="color: #FFD700;">Rp {{ number_format($destination->fee_per_day, 0, ',', '.') }}</strong>
                                        </td>
                                        <td>
                                            @if($destination->is_active)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.destinations.show', $destination->id) }}" class="btn btn-info" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus tujuan ini?');">
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
                                        <td colspan="5" class="text-center text-muted">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($destinations->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $destinations->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
