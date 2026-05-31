@extends('layouts.public')

@section('title', 'OrmawaCash - Sistem Keuangan')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <span class="badge bg-light-custom text-primary-custom px-3 py-2 rounded-pill mb-3 border">
            <i class="bi bi-stars me-1"></i> Transparan & Akuntabel
        </span>
        <h1 class="display-4 fw-bold mb-4 text-dark">
            Ormawa<span class="text-primary-custom">Cash</span>
        </h1>
        <p class="lead text-muted mb-5 max-w-2xl mx-auto" style="max-width: 600px; margin: 0 auto; font-size: 1.1rem;">
            Platform digital untuk mengelola kas, mencatat transaksi, dan mengajukan Rencana Anggaran Biaya (RAB) kegiatan organisasi mahasiswa dengan mudah dan transparan.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('ajukan-rab') }}" class="btn btn-primary-custom btn-lg rounded-pill px-4 shadow-sm" style="font-size: 0.95rem;">
                <i class="bi bi-file-earmark-plus me-1"></i> Ajukan RAB
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 my-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <div class="bg-light-custom rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-wallet2 text-primary-custom fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Manajemen Kas</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">Pencatatan sirkulasi keuangan organisasi mulai dari pemasukan hingga pengeluaran dengan rapi.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <div class="bg-light-custom rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-file-earmark-check text-primary-custom fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Pengajuan RAB</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">Pengurus dapat mengajukan RAB kegiatan secara online dengan alur persetujuan terintegrasi.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100 text-center">
                    <div class="bg-light-custom rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-shield-check text-primary-custom fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Aman & Terkendali</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">Detail sensitif dan data internal dilindungi dengan sistem hak akses (role) yang ketat.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
