@extends('layouts.public')

@section('title', 'Kegiatan')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Agenda & <span class="text-red-primary">Kegiatan</span></h2>
        <p class="text-muted">Daftar kegiatan himpunan yang telah berjalan atau telah disetujui pendanaannya.</p>
    </div>

    <div class="row g-4">
        @forelse($kegiatans as $kegiatan)
            <div class="col-md-6 col-lg-4">
                <div class="glass-card h-100 p-0 overflow-hidden d-flex flex-column">
                    <div class="bg-red-primary p-3 text-white">
                        <span class="badge bg-white text-red-primary mb-2">{{ $kegiatan->departemen->nama_departemen ?? 'Departemen' }}</span>
                        <h5 class="fw-bold mb-0 text-truncate" title="{{ $kegiatan->nama_kegiatan }}">{{ $kegiatan->nama_kegiatan }}</h5>
                    </div>
                    <div class="p-4 flex-grow-1">
                        <div class="mb-3 text-muted small">
                            <i class="bi bi-calendar3 me-2"></i> {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d F Y') }}
                        </div>
                        <p class="card-text mb-0" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $kegiatan->tujuan_kegiatan }}
                        </p>
                    </div>
                    <div class="p-3 border-top bg-light text-center">
                        @if($kegiatan->status === 'Dicairkan')
                            <span class="text-success fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> Terlaksana / Terdanai</span>
                        @else
                            <span class="text-primary fw-semibold"><i class="bi bi-clock-fill me-1"></i> Persiapan / Disetujui</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light text-center py-5 border">
                    <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 text-muted">Belum ada kegiatan yang dapat ditampilkan.</h5>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
