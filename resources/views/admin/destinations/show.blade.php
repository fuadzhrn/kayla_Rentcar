@extends('admin.layouts.app')

@section('title', $destination->name)
@section('page-title', $destination->name)
@section('breadcrumb', 'Detail Tujuan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header with-border">
                <h3 class="card-title">Detail Tujuan Perjalanan</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 style="color: #FFD700;">{{ $destination->name }}</h5>
                        <table class="table table-sm mt-3">
                            <tr>
                                <td class="font-weight-bold" width="40%">Nama Tujuan</td>
                                <td>{{ $destination->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Biaya/Hari</td>
                                <td><strong style="color: #FFD700;">Rp {{ number_format($destination->fee_per_day, 0, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status</td>
                                <td>
                                    @if($destination->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Dibuat</td>
                                <td>{{ $destination->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Diupdate</td>
                                <td>{{ $destination->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-warning float-right">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
