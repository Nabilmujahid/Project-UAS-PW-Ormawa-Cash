@extends('layouts.app')

@section('title', 'Detail Pengajuan RAB')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Informasi Kegiatan</h5>
                <span class="badge bg-secondary rounded-pill px-3">{{ $pengajuan->status }}</span>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="30%" class="text-muted">Nama Kegiatan</td>
                        <td class="fw-semibold">{{ $pengajuan->nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Departemen</td>
                        <td>{{ $pengajuan->departemen->nama_departemen ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">PJ / Pengaju</td>
                        <td>{{ $pengajuan->user->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Kegiatan</td>
                        <td>{{ \Carbon\Carbon::parse($pengajuan->tanggal_kegiatan)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Total Dana Diajukan</td>
                        <td class="fw-bold text-danger fs-5">Rp {{ number_format($pengajuan->total_dana, 0, ',', '.') }}</td>
                    </tr>
                </table>

                <h6 class="fw-bold mt-4 border-bottom pb-2">Tujuan Kegiatan</h6>
                <p class="text-muted">{{ $pengajuan->tujuan_kegiatan }}</p>

                <h6 class="fw-bold mt-4 border-bottom pb-2">Rincian Kebutuhan</h6>
                <pre class="text-muted" style="font-family: inherit; white-space: pre-wrap;">{{ $pengajuan->rincian_kebutuhan }}</pre>
            </div>
        </div>

        @if($pengajuan->catatan_bendahara || $pengajuan->catatan_ketua)
        <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
            <div class="card-body">
                <h6 class="fw-bold mb-3 border-bottom pb-2">Catatan Verifikasi</h6>
                @if($pengajuan->catatan_bendahara)
                    <div class="mb-3">
                        <p class="mb-1 fw-semibold text-dark"><i class="bi bi-person-badge text-warning me-1"></i> Bendahara</p>
                        <div class="p-3 bg-light rounded text-muted small">{{ $pengajuan->catatan_bendahara }}</div>
                    </div>
                @endif
                @if($pengajuan->catatan_ketua)
                    <div>
                        <p class="mb-1 fw-semibold text-dark"><i class="bi bi-person-check text-success me-1"></i> Ketua</p>
                        <div class="p-3 bg-light rounded text-muted small">{{ $pengajuan->catatan_ketua }}</div>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Actions Panel -->
    <div class="col-md-4">
        @if(Auth::user()->role === 'bendahara' && $pengajuan->status === 'Menunggu Verifikasi Bendahara')
        <div class="card shadow-sm border-0 border-top border-warning border-4 mb-4" style="border-radius: 15px;">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Aksi Verifikasi (Bendahara)</h6>
                <form action="{{ route('pengajuan-rab.verifikasi', $pengajuan->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small text-muted">Catatan (Opsional)</label>
                        <textarea name="catatan_bendahara" class="form-control form-control-sm" rows="3">{{ $pengajuan->catatan_bendahara }}</textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="aksi" value="terima" class="btn btn-success btn-sm rounded-pill"><i class="bi bi-check-lg"></i> Terima & Lanjut ke Ketua</button>
                        <button type="submit" name="aksi" value="revisi" class="btn btn-warning btn-sm rounded-pill text-dark"><i class="bi bi-pencil-square"></i> Minta Revisi</button>
                        <button type="submit" name="aksi" value="tolak" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Yakin ingin menolak RAB ini?')"><i class="bi bi-x-lg"></i> Tolak RAB</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        @if(Auth::user()->role === 'ketua' && $pengajuan->status === 'Menunggu Persetujuan Ketua')
        <div class="card shadow-sm border-0 border-top border-success border-4 mb-4" style="border-radius: 15px;">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Aksi Persetujuan (Ketua)</h6>
                <form action="{{ route('pengajuan-rab.persetujuan', $pengajuan->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small text-muted">Catatan (Opsional)</label>
                        <textarea name="catatan_ketua" class="form-control form-control-sm" rows="3">{{ $pengajuan->catatan_ketua }}</textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="aksi" value="terima" class="btn btn-success btn-sm rounded-pill"><i class="bi bi-check-lg"></i> Setujui RAB</button>
                        <button type="submit" name="aksi" value="revisi" class="btn btn-warning btn-sm rounded-pill text-dark"><i class="bi bi-pencil-square"></i> Minta Revisi</button>
                        <button type="submit" name="aksi" value="tolak" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Yakin ingin menolak RAB ini?')"><i class="bi bi-x-lg"></i> Tolak RAB</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        @if(Auth::user()->role === 'bendahara' && $pengajuan->status === 'Disetujui/Diterima')
        <div class="card shadow-sm border-0 border-top border-primary border-4 mb-4" style="border-radius: 15px;">
            <div class="card-body text-center py-4">
                <i class="bi bi-cash-coin fs-1 text-primary mb-2"></i>
                <h6 class="fw-bold mb-1">RAB Telah Disetujui</h6>
                <p class="small text-muted mb-3">Silakan cairkan dana ini. Sistem akan otomatis mencatatnya sebagai transaksi pengeluaran.</p>
                <form action="{{ route('pengajuan-rab.cairkan', $pengajuan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm" onclick="return confirm('Yakin ingin mencairkan dana ini dan mencatat ke transaksi?')">Cairkan Dana</button>
                </form>
            </div>
        </div>
        @endif

        <div class="d-grid">
            <a href="{{ route('pengajuan-rab.index') }}" class="btn btn-light border rounded-pill">Kembali</a>
        </div>
    </div>
</div>
@endsection
