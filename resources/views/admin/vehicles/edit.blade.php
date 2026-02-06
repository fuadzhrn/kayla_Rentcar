@extends('admin.layouts.app')

@section('title', 'Edit Kendaraan')
@section('page-title', 'Edit Kendaraan')
@section('breadcrumb', 'Edit Kendaraan')

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-warning">
            <div class="card-header with-border">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i> Edit Kendaraan: {{ $vehicle->name }}
                </h3>
            </div>

            <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <!-- UPLOAD GAMBAR BARU -->
                    <div class="form-group">
                        <label for="image">Ganti Foto Kendaraan (Opsional)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                <label class="custom-file-label" for="image">Pilih gambar baru (untuk mengganti foto utama)...</label>
                            </div>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG, GIF (Max 5MB). Gambar baru akan menjadi foto utama kendaraan.</small>
                        @error('image')
                            <span class="invalid-feedback" style="display:block;">{{ $message }}</span>
                        @enderror
                        <!-- Preview Gambar Baru -->
                        <div id="imagePreview" style="margin-top: 15px; display: none;">
                            <img id="previewImg" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 5px; border: 2px solid #FFD700;">
                        </div>
                    </div>

                    <!-- Foto Utama Saat Ini -->
                    <div class="form-group">
                        <label>Foto Utama Saat Ini</label>
                        <div style="padding: 10px; background-color: rgba(26,26,26,0.7); border-radius: 5px;">
                            @if($vehicle->images()->where('is_primary', true)->count() > 0)
                                <img src="{{ $vehicle->primary_image }}" alt="{{ $vehicle->name }}" style="max-width: 200px; max-height: 200px; border-radius: 5px; border: 2px solid #FFD700;" onerror="this.src='/img/gambar_bg.png'">
                                <p class="mt-2 text-muted"><small>Foto akan diganti jika Anda upload foto baru</small></p>
                            @else
                                <p class="text-muted"><small><i class="fas fa-info-circle"></i> Kendaraan ini belum memiliki foto utama</small></p>
                            @endif
                        </div>
                    </div>

                    <hr style="border-top: 2px solid #FFD700;">

                    <!-- BAGIAN 1: INFORMASI DASAR -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h5 class="mb-3" style="color: #FFD700; border-bottom: 2px solid #FFD700; padding-bottom: 10px;">
                                <i class="fas fa-info-circle"></i> Informasi Dasar Kendaraan
                            </h5>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Nama Kendaraan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $vehicle->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transmission">Transmisi <span class="text-danger">*</span></label>
                                <select class="form-control @error('transmission') is-invalid @enderror" id="transmission" name="transmission" required>
                                    <option value="Manual" {{ old('transmission', $vehicle->transmission) == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="Automatic" {{ old('transmission', $vehicle->transmission) == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                                </select>
                                @error('transmission')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="seat_capacity">Kapasitas Penumpang <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('seat_capacity') is-invalid @enderror" id="seat_capacity" name="seat_capacity" value="{{ old('seat_capacity', $vehicle->seat_capacity) }}" min="1" max="10" required>
                                <small class="form-text text-muted">Jumlah orang yang dapat ditampung termasuk driver</small>
                                @error('seat_capacity')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 2: SPESIFIKASI TEKNIS -->
                    <div class="row mb-3 mt-3">
                        <div class="col-md-12">
                            <h5 class="mb-3" style="color: #FFD700; border-bottom: 2px solid #FFD700; padding-bottom: 10px;">
                                <i class="fas fa-cogs"></i> Spesifikasi Teknis
                            </h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="engine_cc">Kapasitas Mesin (CC) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('engine_cc') is-invalid @enderror" id="engine_cc" name="engine_cc" value="{{ old('engine_cc', $vehicle->engine_cc) }}" required>
                                <small class="form-text text-muted">Contoh: 1000, 1200, 1496, 1800, 2000</small>
                                @error('engine_cc')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fuel_type">Jenis Bahan Bakar <span class="text-danger">*</span></label>
                                <select class="form-control @error('fuel_type') is-invalid @enderror" id="fuel_type" name="fuel_type" required>
                                    <option value="Petrol" {{ old('fuel_type', $vehicle->fuel_type) == 'Petrol' ? 'selected' : '' }}>Bensin (Petrol)</option>
                                    <option value="Diesel" {{ old('fuel_type', $vehicle->fuel_type) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                    <option value="Hybrid" {{ old('fuel_type', $vehicle->fuel_type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                </select>
                                @error('fuel_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 3: HARGA -->
                    <div class="row mb-3 mt-3">
                        <div class="col-md-12">
                            <h5 class="mb-3" style="color: #FFD700; border-bottom: 2px solid #FFD700; padding-bottom: 10px;">
                                <i class="fas fa-money-bill-wave"></i> Informasi Harga Sewa
                            </h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price_per_day">Harga per Hari (Rp) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('price_per_day') is-invalid @enderror" id="price_per_day" name="price_per_day" value="{{ old('price_per_day', $vehicle->price_per_day) }}" required>
                                <small class="form-text text-muted">Harga untuk 1 hari (24 jam)</small>
                                @error('price_per_day')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price_per_week">Harga per Minggu (Rp)</label>
                                <input type="number" class="form-control @error('price_per_week') is-invalid @enderror" id="price_per_week" name="price_per_week" value="{{ old('price_per_week', $vehicle->price_per_week) }}">
                                <small class="form-text text-muted">Harga untuk 7 hari (opsional)</small>
                                @error('price_per_week')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price_per_month">Harga per Bulan (Rp)</label>
                                <input type="number" class="form-control @error('price_per_month') is-invalid @enderror" id="price_per_month" name="price_per_month" value="{{ old('price_per_month', $vehicle->price_per_month) }}">
                                <small class="form-text text-muted">Harga untuk 30 hari (opsional)</small>
                                @error('price_per_month')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 4: INFORMASI TAMBAHAN -->
                    <div class="row mb-3 mt-3">
                        <div class="col-md-12">
                            <h5 class="mb-3" style="color: #FFD700; border-bottom: 2px solid #FFD700; padding-bottom: 10px;">
                                <i class="fas fa-align-left"></i> Informasi Tambahan
                            </h5>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi Kendaraan</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $vehicle->description) }}</textarea>
                        <small class="form-text text-muted">Deskripsi akan ditampilkan di halaman detail kendaraan</small>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Fasilitas Kendaraan</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="has_ac" name="has_ac" value="1" {{ old('has_ac', $vehicle->has_ac) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="has_ac">
                                <i class="fas fa-fan" style="color: #FFD700;"></i> Kendaraan memiliki AC dingin
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status Ketersediaan</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_available" name="is_available" value="1" {{ old('is_available', $vehicle->is_available) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_available">
                                @if($vehicle->is_available)
                                    <span class="badge badge-success">Kendaraan Tersedia</span>
                                @else
                                    <span class="badge badge-danger">Kendaraan Tidak Tersedia</span>
                                @endif
                                untuk disewa
                            </label>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Batal / Kembali
                    </a>
                    <button type="reset" class="btn btn-warning">
                        <i class="fas fa-redo"></i> Reset Form
                    </button>
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i> Update Kendaraan
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">
                <i class="fas fa-lightbulb"></i> Informasi Edit
            </h4>
            <ul class="mb-0">
                <li>Untuk menambahkan atau mengubah foto kendaraan, gunakan menu <strong>Galeri Foto</strong></li>
                <li>Anda juga dapat mengganti foto utama langsung di form edit ini</li>
                <li>Perubahan harga akan langsung diterapkan untuk penyewaan baru</li>
                <li>Setiap perubahan akan dicatat dalam sistem</li>
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>

<script>
    // Preview gambar saat user memilih file
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewDiv = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const fileInput = this;

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewDiv.style.display = 'block';
            };
            reader.readAsDataURL(file);

            // Update label dengan nama file
            const label = fileInput.nextElementSibling;
            label.textContent = file.name;
        } else {
            previewDiv.style.display = 'none';
        }
    });

    // Update file input label
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Pilih gambar baru (untuk mengganti foto utama)...';
        this.nextElementSibling.textContent = fileName;
    });
</script>
@endsection
