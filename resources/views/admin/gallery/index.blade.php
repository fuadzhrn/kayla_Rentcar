@extends('admin.layouts.app')

@section('title', 'Galeri Foto')
@section('page-title', 'Galeri Foto')
@section('breadcrumb', 'Galeri Foto')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Manajemen Galeri Foto</h3>
                <div class="card-tools pull-right">
                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Upload Foto Baru
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($galleries->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Galeri kosong. 
                        <a href="{{ route('admin.gallery.create') }}">Upload foto sekarang</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="galleriesTable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Foto</th>
                                    <th width="20%">Judul</th>
                                    <th width="35%">Deskripsi</th>
                                    <th width="10%">Featured</th>
                                    <th width="12%">Tanggal</th>
                                    <th width="8%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($galleries as $key => $gallery)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 5px;">
                                        </td>
                                        <td>
                                            <strong>{{ $gallery->title }}</strong>
                                        </td>
                                        <td>
                                            {{ substr($gallery->description ?? '-', 0, 50) }}{{ strlen($gallery->description ?? '') > 50 ? '...' : '' }}
                                        </td>
                                        <td>
                                            @if($gallery->is_featured)
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-star"></i> Featured
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">Normal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $gallery->created_at->format('d M Y') }}</small>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus foto ini?')">
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
                                        <td colspan="7" class="text-center text-muted">
                                            <i class="fas fa-image"></i> Tidak ada foto
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $galleries->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Info Box -->
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">
                <i class="fas fa-lightbulb"></i> Informasi Galeri
            </h4>
            <ul class="mb-0">
                <li>Galeri ini untuk upload foto umum (bukan foto kendaraan)</li>
                <li>Foto-foto yang diupload akan ditampilkan di halaman Gallery yang dapat dilihat pengunjung</li>
                <li>Anda dapat menandai foto sebagai "Featured" agar ditampilkan lebih menonjol</li>
                <li>Gunakan kategori yang sesuai untuk mengorganisir foto (General, Event, Promo, Featured)</li>
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#galleriesTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
            },
            responsive: true,
            pageLength: 10
        });
    });
</script>
@endsection
