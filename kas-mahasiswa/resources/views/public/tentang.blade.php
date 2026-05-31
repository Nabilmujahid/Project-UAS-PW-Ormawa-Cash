@extends('layouts.public')

@section('title', 'Tentang Sistem')

@section('content')
<div class="container py-5">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
            <h2 class="fw-bold mb-3">Tentang <span class="text-red-primary">Sistem Kas & RAB</span></h2>
            <p class="lead text-muted">Platform digital untuk mewujudkan tata kelola keuangan organisasi yang modern, transparan, dan akuntabel.</p>
            <p>
                Sistem ini dibangun untuk mempermudah proses pengelolaan dana himpunan, mulai dari pencatatan iuran, pemasukan sponsor, hingga penyaluran dana untuk kegiatan kemahasiswaan melalui mekanisme Rencana Anggaran Biaya (RAB) yang terstruktur.
            </p>
            <div class="d-flex gap-3 mt-4">
                <div class="d-flex align-items-center text-red-primary fw-semibold">
                    <i class="bi bi-check2-circle fs-4 me-2"></i> Transparan
                </div>
                <div class="d-flex align-items-center text-red-primary fw-semibold">
                    <i class="bi bi-check2-circle fs-4 me-2"></i> Akuntabel
                </div>
                <div class="d-flex align-items-center text-red-primary fw-semibold">
                    <i class="bi bi-check2-circle fs-4 me-2"></i> Aman
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="glass-card p-5 text-center bg-red-light border-0">
                <i class="bi bi-shield-lock text-red-primary mb-3" style="font-size: 5rem;"></i>
                <h4 class="fw-bold">Keamanan & Privasi</h4>
                <p class="text-muted mb-0">Sistem menerapkan konsep transparansi terbatas. Informasi yang bersifat umum dapat diakses oleh publik, sementara detail transaksi dan RAB dilindungi oleh sistem login dengan multi-hak akses (Bendahara, Ketua, dan Pengurus).</p>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-4 border-top">
        <div class="col-12 text-center mb-5">
            <h3 class="fw-bold">Alur Pengajuan RAB Kegiatan</h3>
        </div>
        
        <div class="col-md-3 text-center mb-4">
            <div class="rounded-circle bg-red-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                <i class="bi bi-1-circle text-red-primary fs-1"></i>
            </div>
            <h5 class="fw-bold">Pengajuan</h5>
            <p class="small text-muted">Pengurus mengisi form RAB kegiatan secara lengkap melalui dashboard.</p>
        </div>
        
        <div class="col-md-3 text-center mb-4">
            <div class="rounded-circle bg-red-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                <i class="bi bi-2-circle text-red-primary fs-1"></i>
            </div>
            <h5 class="fw-bold">Verifikasi Bendahara</h5>
            <p class="small text-muted">Bendahara mengecek kelengkapan rincian dan ketersediaan kas.</p>
        </div>
        
        <div class="col-md-3 text-center mb-4">
            <div class="rounded-circle bg-red-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                <i class="bi bi-3-circle text-red-primary fs-1"></i>
            </div>
            <h5 class="fw-bold">Persetujuan Ketua</h5>
            <p class="small text-muted">Ketua memberikan keputusan akhir apakah kegiatan layak didanai.</p>
        </div>
        
        <div class="col-md-3 text-center mb-4">
            <div class="rounded-circle bg-red-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                <i class="bi bi-4-circle text-red-primary fs-1"></i>
            </div>
            <h5 class="fw-bold">Pencairan Dana</h5>
            <p class="small text-muted">Dana dicairkan oleh bendahara dan otomatis tercatat di sistem kas.</p>
        </div>
    </div>
</div>
@endsection
