@extends('layouts.app')

@section('title', 'Form Pengajuan RAB')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card shadow-sm border-0" style="border-radius: 15px;">
            <div class="card-body p-4">
                <form action="{{ route('pengajuan-rab.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" class="form-control rounded-pill" value="{{ old('nama_kegiatan') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Departemen</label>
                            <select name="departemen_id" class="form-select rounded-pill" required>
                                <option value="">Pilih Departemen...</option>
                                @foreach($departemens as $dept)
                                    <option value="{{ $dept->id }}" {{ old('departemen_id') == $dept->id ? 'selected' : '' }}>{{ $dept->nama_departemen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Pelaksanaan</label>
                            <input type="date" name="tanggal_kegiatan" class="form-control rounded-pill" value="{{ old('tanggal_kegiatan') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Total Dana Diajukan (Rp)</label>
                            <input type="number" name="total_dana" class="form-control rounded-pill" value="{{ old('total_dana') }}" required min="0">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Tujuan Kegiatan</label>
                            <textarea name="tujuan_kegiatan" class="form-control" rows="3" style="border-radius: 15px;" required>{{ old('tujuan_kegiatan') }}</textarea>
                        </div>
                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">Rincian Kebutuhan Dana</label>
                            <textarea name="rincian_kebutuhan" class="form-control" rows="5" style="border-radius: 15px;" placeholder="Contoh: 1. Konsumsi 50 x 20rb = 1jt&#10;2. Spanduk = 150rb" required>{{ old('rincian_kebutuhan') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="{{ route('pengajuan-rab.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
                        <button type="submit" class="btn btn-danger rounded-pill px-4 shadow-sm"><i class="bi bi-send me-1"></i> Ajukan RAB</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
