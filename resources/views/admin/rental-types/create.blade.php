@extends('admin.layouts.app')

@section('title', 'Tambah Jenis Layanan')
@section('page-title', 'Tambah Jenis Layanan')
@section('breadcrumb', 'Tambah')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header with-border">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle"></i> Form Tambah Jenis Layanan
                </h3>
            </div>
            <form action="{{ route('admin.rental-types.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Layanan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Contoh: Lepas Kunci" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Jelaskan layanan ini..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="icon">Icon <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" placeholder="Contoh: fa-key" value="{{ old('icon') }}" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i id="iconPreview" class="fas fa-key" style="font-size: 1.3em;"></i>
                                </span>
                            </div>
                        </div>
                        <small class="form-text text-muted">Gunakan Font Awesome icon names (tanpa prefix "fas "). Contoh: fa-key, fa-car-side, fa-user-tie, fa-plane, fa-map-location-dot</small>
                        @error('icon')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="order">Order <span class="text-muted">(Opsional)</span></label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" min="0" placeholder="Nomor urutan tampilan" value="{{ old('order') }}">
                        <small class="form-text text-muted">Urutan tampilan di halaman publik (0 = pertama)</small>
                        @error('order')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.rental-types.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header with-border">
                <h5 class="card-title"><i class="fas fa-info-circle"></i> Panduan Icon</h5>
            </div>
            <div class="card-body">
                <p class="small"><strong>Rekomendasi Font Awesome Icons:</strong></p>
                <ul class="small">
                    <li><code>fa-key</code> - Lepas Kunci</li>
                    <li><code>fa-car-side</code> - Mobil + Driver</li>
                    <li><code>fa-user-tie</code> - Driver Only</li>
                    <li><code>fa-plane</code> - Bandara</li>
                    <li><code>fa-map-location-dot</code> - Wisata</li>
                </ul>
                <hr>
                <p class="small text-muted">
                    Cari icon lain di <a href="https://fontawesome.com/icons" target="_blank">Font Awesome Icons</a>. Gunakan nama icon tanpa prefix "fas ".
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('icon').addEventListener('input', function() {
        const iconName = this.value.trim();
        const preview = document.getElementById('iconPreview');
        if (iconName) {
            preview.className = 'fas ' + iconName;
        }
    });
</script>
@endsection
