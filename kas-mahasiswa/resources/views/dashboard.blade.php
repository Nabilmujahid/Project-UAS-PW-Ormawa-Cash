@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@if(Auth::user()->role === 'bendahara' || Auth::user()->role === 'ketua')

<div class="mb-4">
    <h4 class="fw-bold mb-1">Selamat datang, {{ Auth::user()->name }}</h4>
    <p class="text-muted mb-0">Berikut ringkasan keuangan dan pengajuan RAB organisasi.</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 text-white" style="background: linear-gradient(135deg, #0f766e, #115e59);">
            <div class="card-body p-4">
                <p class="text-white-50 text-uppercase fw-bold mb-2" style="font-size: 0.75rem;">Saldo Kas Saat Ini</p>
                <h3 class="fw-bold mb-0">Rp {{ number_format($totalKas ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <p class="text-muted text-uppercase fw-bold mb-2" style="font-size: 0.75rem;">Pemasukan Bulan Ini</p>
                <h3 class="fw-bold text-success mb-0">Rp {{ number_format($pemasukanBulanIni ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <p class="text-muted text-uppercase fw-bold mb-2" style="font-size: 0.75rem;">Pengeluaran Bulan Ini</p>
                <h3 class="fw-bold text-danger mb-0">Rp {{ number_format($pengeluaranBulanIni ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h5 class="fw-bold mb-1">Ringkasan Pengajuan RAB</h5>
        <p class="text-muted mb-0 small">Status pengajuan RAB yang masuk ke sistem.</p>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3 col-6">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body py-4">
                <h2 class="fw-bold mb-1">{{ $rabMasuk ?? 0 }}</h2>
                <p class="text-muted mb-0 small">Total RAB Masuk</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body py-4">
                <h2 class="fw-bold text-warning mb-1">{{ ($rabMenungguBendahara ?? 0) + ($rabMenungguKetua ?? 0) }}</h2>
                <p class="text-muted mb-0 small">Menunggu Verifikasi</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body py-4">
                <h2 class="fw-bold text-success mb-1">{{ $rabDisetujui ?? 0 }}</h2>
                <p class="text-muted mb-0 small">Disetujui / Cair</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body py-4">
                <h2 class="fw-bold text-danger mb-1">{{ $rabDitolak ?? 0 }}</h2>
                <p class="text-muted mb-0 small">Ditolak</p>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->role === 'bendahara')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <div>
            <h5 class="fw-bold mb-0">RAB Menunggu Verifikasi Bendahara</h5>
            <small class="text-muted">Daftar pengajuan yang perlu diproses.</small>
        </div>
        <a href="{{ route('pengajuan-rab.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Kegiatan</th>
                        <th>Pengaju</th>
                        <th>Total Dana</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentRabs as $rab)
                    <tr>
                        <td class="ps-4 fw-semibold">{{ $rab->nama_kegiatan }}</td>
                        <td>{{ $rab->user->name ?? '-' }}</td>
                        <td class="fw-semibold text-danger">Rp {{ number_format($rab->total_dana, 0, ',', '.') }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ route('pengajuan-rab.show', $rab->id) }}" class="btn btn-primary btn-sm">Proses</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Tidak ada RAB yang menunggu verifikasi saat ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->role === 'ketua')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <div>
            <h5 class="fw-bold mb-0">RAB Menunggu Persetujuan Ketua</h5>
            <small class="text-muted">Daftar pengajuan yang perlu diperiksa.</small>
        </div>
        <a href="{{ route('pengajuan-rab.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Kegiatan</th>
                        <th>Departemen</th>
                        <th>Total Dana</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ketuaRabs as $rab)
                    <tr>
                        <td class="ps-4 fw-semibold">{{ $rab->nama_kegiatan }}</td>
                        <td>{{ $rab->departemen->nama_departemen ?? '-' }}</td>
                        <td class="fw-semibold text-danger">Rp {{ number_format($rab->total_dana, 0, ',', '.') }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ route('pengajuan-rab.show', $rab->id) }}" class="btn btn-primary btn-sm">Periksa</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Tidak ada RAB yang menunggu persetujuan saat ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@endif


@if(Auth::user()->role === 'pengurus')

<div class="card border-0 shadow-sm mb-4 text-white" style="background: linear-gradient(135deg, #0f766e, #115e59);">
    <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-1">Selamat datang, {{ Auth::user()->name }}</h4>
            <p class="mb-0 text-white-50">Ajukan RAB kegiatan dan pantau status pengajuan Anda.</p>
        </div>
        <a href="{{ route('pengajuan-rab.create') }}" class="btn btn-light fw-semibold">Ajukan RAB Baru</a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 text-center">
            <div class="card-body py-4">
                <h2 class="fw-bold mb-1">{{ $myRabCount ?? 0 }}</h2>
                <p class="text-muted mb-0">Total RAB Anda</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Status Pengajuan Terakhir</h5>
            </div>
            <div class="card-body">
                @if($myRabTerbaru)
                    @php
                        $badgeClass = 'bg-secondary';
                        if(str_contains($myRabTerbaru->status, 'Menunggu')) $badgeClass = 'bg-warning text-dark';
                        elseif(str_contains($myRabTerbaru->status, 'Revisi')) $badgeClass = 'bg-info text-dark';
                        elseif(str_contains($myRabTerbaru->status, 'Ditolak')) $badgeClass = 'bg-danger';
                        elseif(str_contains($myRabTerbaru->status, 'Disetujui') || str_contains($myRabTerbaru->status, 'Dicairkan')) $badgeClass = 'bg-success';
                    @endphp

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h6 class="fw-bold mb-1">{{ $myRabTerbaru->nama_kegiatan }}</h6>
                            <p class="text-muted mb-0 small">
                                Diajukan: {{ \Carbon\Carbon::parse($myRabTerbaru->created_at)->format('d M Y') }}
                            </p>
                        </div>

                        <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2">
                            {{ $myRabTerbaru->status }}
                        </span>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('pengajuan-rab.show', $myRabTerbaru->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                @else
                    <p class="text-muted mb-0">Anda belum pernah mengajukan RAB.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <div>
            <h5 class="fw-bold mb-0">Riwayat Pengajuan RAB</h5>
            <small class="text-muted">Daftar pengajuan RAB yang pernah Anda buat.</small>
        </div>
        <a href="{{ route('pengajuan-rab.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
    </div>

    <div class="card-body">
        <p class="text-muted mb-0">Gunakan menu Status Pengajuan untuk melihat seluruh riwayat pengajuan RAB Anda.</p>
    </div>
</div>

@endif

@endsection