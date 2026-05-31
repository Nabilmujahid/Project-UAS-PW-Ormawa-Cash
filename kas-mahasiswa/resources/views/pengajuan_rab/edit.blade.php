@extends('layouts.app')

@section('title', 'Revisi Pengajuan RAB')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card shadow-sm border-0 border-top border-info border-4" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="alert alert-info border-0 rounded-pill mb-4 text-center">
                    <i class="bi bi-info-circle me-1"></i> Silakan perbaiki RAB berdasarkan catatan verifikasi.
                </div>

                <form action="{{ route('pengajuan-rab.update', $pengajuan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" class="form-control rounded-pill" value="{{ old('nama_kegiatan', $pengajuan->nama_kegiatan) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Departemen</label>
                            <select name="departemen_id" class="form-select rounded-pill" required>
                                <option value="">Pilih Departemen...</option>
                                @foreach($departemens as $dept)
                                    <option value="{{ $dept->id }}" {{ (old('departemen_id') ?? $pengajuan->departemen_id) == $dept->id ? 'selected' : '' }}>{{ $dept->nama_departemen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Pelaksanaan</label>
                            <input type="date" name="tanggal_kegiatan" class="form-control rounded-pill" value="{{ old('tanggal_kegiatan', $pengajuan->tanggal_kegiatan) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Total Dana Diajukan (Rp)</label>
                            <input type="number" name="total_dana" class="form-control rounded-pill" value="{{ old('total_dana', $pengajuan->total_dana) }}" required min="0">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Tujuan Kegiatan</label>
                            <textarea name="tujuan_kegiatan" class="form-control" rows="3" style="border-radius: 15px;" required>{{ old('tujuan_kegiatan', $pengajuan->tujuan_kegiatan) }}</textarea>
                        </div>
                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">Rincian Kebutuhan Dana</label>
                            <textarea name="rincian_kebutuhan" class="form-control" rows="5" style="border-radius: 15px;" required>{{ old('rincian_kebutuhan', $pengajuan->rincian_kebutuhan) }}</textarea>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="{{ route('pengajuan-rab.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
                        <button type="submit" class="btn btn-info text-white rounded-pill px-4 shadow-sm"><i class="bi bi-send-check me-1"></i> Simpan & Kirim Ulang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
