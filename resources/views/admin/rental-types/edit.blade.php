@extends('admin.layouts.app')

@section('title', 'Edit Jenis Layanan')
@section('page-title', 'Edit Jenis Layanan')
@section('breadcrumb', 'Edit')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header with-border">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i> Form Edit Jenis Layanan
                </h3>
            </div>
            <form action="{{ route('admin.rental-types.update', $rentalType->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Layanan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Contoh: Lepas Kunci" value="{{ old('name', $rentalType->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Jelaskan layanan ini..." required>{{ old('description', $rentalType->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="icon">Icon <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" placeholder="Contoh: fa-key" value="{{ old('icon', $rentalType->icon) }}" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i id="iconPreview" class="fas {{ $rentalType->icon }}" style="font-size: 1.3em;"></i>
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
                        <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" min="0" placeholder="Nomor urutan tampilan" value="{{ old('order', $rentalType->order) }}">
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
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header with-border">
                <h5 class="card-title"><i class="fas fa-info-circle"></i> Informasi</h5>
            </div>
            <div class="card-body">
                <p class="small"><strong>Dibuat:</strong> {{ $rentalType->created_at->format('d M Y H:i') }}</p>
                <p class="small"><strong>Diupdate:</strong> {{ $rentalType->updated_at->format('d M Y H:i') }}</p>
                <hr>
                <p class="small text-muted">
                    Perubahan akan langsung tercermin di halaman publik.
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
