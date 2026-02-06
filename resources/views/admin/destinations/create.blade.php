@extends('admin.layouts.app')

@section('title', 'Tambah Tujuan Perjalanan')
@section('page-title', 'Tambah Tujuan Perjalanan Baru')
@section('breadcrumb', 'Tambah Tujuan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Validation Errors Alert -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5><i class="fas fa-exclamation-circle"></i> Validasi Gagal!</h5>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <div class="card card-primary">
            <div class="card-header with-border">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle"></i> Form Tambah Tujuan Perjalanan
                </h3>
            </div>

            <form action="{{ route('admin.destinations.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Tujuan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Dalam Kota, Luar Kota, Antar Provinsi" required>
                        <small class="form-text text-muted">Nama unik untuk tujuan perjalanan</small>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fee_per_day">Biaya Tambahan per Hari (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('fee_per_day') is-invalid @enderror" id="fee_per_day" name="fee_per_day" value="{{ old('fee_per_day') }}" placeholder="Contoh: 250000" min="0" step="1000" required>
                        <small class="form-text text-muted">Biaya tambahan per hari untuk tujuan ini (selain harga kendaraan dasar)</small>
                        @error('fee_per_day')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Status Tujuan</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                            <label class="custom-control-label" for="is_active">
                                <span class="badge badge-success">Tujuan Aktif</span> dan dapat dipilih oleh user
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Batal / Kembali
                    </a>
                    <button type="reset" class="btn btn-warning">
                        <i class="fas fa-redo"></i> Reset Form
                    </button>
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i> Simpan Tujuan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
