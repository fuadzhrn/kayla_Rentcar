@extends('admin.layouts.app')

@section('title', 'Upload Foto Galeri')
@section('page-title', 'Upload Foto Galeri')
@section('breadcrumb', 'Upload Foto')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header with-border">
                <h3 class="card-title">
                    <i class="fas fa-upload"></i> Form Upload Foto Galeri
                </h3>
            </div>
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- Preview Gambar -->
                    <div class="form-group">
                        <label for="image">Upload Foto <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                                <label class="custom-file-label" for="image">Pilih file foto...</label>
                            </div>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG, GIF (Max 5MB)</small>
                        @error('image')
                            <span class="invalid-feedback" style="display:block;">{{ $message }}</span>
                        @enderror
                        <!-- Preview -->
                        <div id="imagePreview" style="margin-top: 15px; display: none;">
                            <img id="previewImg" src="" alt="Preview" style="max-width: 300px; max-height: 300px; border-radius: 5px; border: 2px solid #FFD700;">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="title">Judul Foto (Opsional)</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Contoh: Kantor Pusat, Event 2024, dll" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi Foto (Opsional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Jelaskan tentang foto ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <strong>Tandai sebagai Featured Photo</strong> (akan ditampilkan lebih menonjol)
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Batal / Kembali
                    </a>
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-upload"></i> Upload Foto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header with-border">
                <h5 class="card-title"><i class="fas fa-info-circle"></i> Tips Upload</h5>
            </div>
            <div class="card-body">
                <ul class="small mb-0">
                    <li><strong>Format:</strong> JPG, JPEG, PNG, GIF</li>
                    <li><strong>Ukuran Max:</strong> 5MB per foto</li>
                    <li><strong>Rekomendasi:</strong> 1200x800 pixel atau lebih</li>
                    <li><strong>Kategori:</strong> Gunakan untuk mengorganisir foto</li>
                    <li><strong>Featured:</strong> Foto featured akan ditampilkan lebih menonjol</li>
                    <li><strong>Galeri User:</strong> Semua foto akan ditampilkan di halaman Gallery public</li>
                </ul>
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
        const fileName = e.target.files[0]?.name || 'Pilih file foto...';
        this.nextElementSibling.textContent = fileName;
    });
</script>
@endsection
