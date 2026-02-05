@extends('admin.layouts.app')

@section('title', 'Edit Foto Galeri')
@section('page-title', 'Edit Foto Galeri')
@section('breadcrumb', 'Edit Foto')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-warning">
            <div class="card-header with-border">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i> Edit Foto Galeri
                </h3>
            </div>
            <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <!-- Foto Saat Ini -->
                    <div class="form-group">
                        <label>Foto Saat Ini</label>
                        <div style="padding: 10px; background-color: rgba(26,26,26,0.7); border-radius: 5px; margin-bottom: 15px;">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" style="max-width: 400px; max-height: 300px; border-radius: 5px; border: 2px solid #FFD700;">
                        </div>
                    </div>

                    <!-- Ganti Foto -->
                    <div class="form-group">
                        <label for="image">Ganti Foto (Opsional)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                <label class="custom-file-label" for="image">Pilih file baru...</label>
                            </div>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG, GIF (Max 5MB). Kosongkan jika tidak ingin mengganti foto.</small>
                        @error('image')
                            <span class="invalid-feedback" style="display:block;">{{ $message }}</span>
                        @enderror
                        <!-- Preview Foto Baru -->
                        <div id="imagePreview" style="margin-top: 15px; display: none;">
                            <img id="previewImg" src="" alt="Preview" style="max-width: 300px; max-height: 300px; border-radius: 5px; border: 2px solid #FFD700;">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="title">Judul Foto</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $gallery->title) }}">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi Foto</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $gallery->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}>
                            <strong>Tandai sebagai Featured Photo</strong>
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Batal / Kembali
                    </a>
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i> Simpan Perubahan
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
                <p><strong>Diupload:</strong> {{ $gallery->created_at->format('d M Y H:i') }}</p>
                <p><strong>Kategori:</strong> <span class="badge badge-info">{{ ucfirst($gallery->category) }}</span></p>
                <p><strong>Status:</strong> 
                    @if($gallery->is_featured)
                        <span class="badge badge-warning"><i class="fas fa-star"></i> Featured</span>
                    @else
                        <span class="badge badge-secondary">Normal</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview gambar saat user memilih file
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewDiv = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewDiv.style.display = 'block';
            };
            reader.readAsDataURL(file);

            // Update label
            this.nextElementSibling.textContent = file.name;
        } else {
            previewDiv.style.display = 'none';
        }
    });

    // Update file input label
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Pilih file baru...';
        this.nextElementSibling.textContent = fileName;
    });
</script>
@endsection
