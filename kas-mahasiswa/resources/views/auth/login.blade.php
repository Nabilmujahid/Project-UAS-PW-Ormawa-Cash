@extends('layouts.app')

@section('title', 'Login OrmawaCash')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ecfdf5 0%, #f8fafc 45%, #d1fae5 100%); padding: 30px;">
    <div class="row shadow-lg rounded-4 overflow-hidden bg-white" style="max-width: 950px; width: 100%;">

        <!-- Left Section -->
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center p-5 text-white" style="background: linear-gradient(135deg, #047857, #0f766e);">
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-25 rounded-circle mb-3" style="width: 70px; height: 70px;">
                    <i class="bi bi-wallet2 fs-2"></i>
                </div>
                <h2 class="fw-bold mb-3">OrmawaCash</h2>
                <p class="mb-0" style="line-height: 1.8;">
                    Sistem pengelolaan kas dan pengajuan RAB organisasi mahasiswa yang membantu pencatatan keuangan menjadi lebih rapi, aman, dan transparan.
                </p>
            </div>

            <div class="mt-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <span>Manajemen kas organisasi</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <span>Pengajuan RAB kegiatan</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <span>Akses berdasarkan role pengguna</span>
                </div>
            </div>
        </div>

        <!-- Login Form -->
        <div class="col-md-6 p-5">
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 65px; height: 65px; background-color: #ccfbf1; color: #0f766e;">
                    <i class="bi bi-cash-coin fs-2"></i>
                </div>
                <h3 class="fw-bold mb-1" style="color: #0f172a;">Login OrmawaCash</h3>
                <p class="text-muted mb-0">Masuk untuk mengelola data kas organisasi</p>
            </div>

            @if (session('info'))
                <div class="alert alert-info rounded-3">
                    {{ session('info') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success rounded-3">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-envelope text-muted"></i>
                        </span>
                        <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="Masukkan email" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-lock text-muted"></i>
                        </span>
                        <input type="password" name="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="password" placeholder="Masukkan password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn w-100 text-white fw-semibold py-2 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #0f766e, #047857);">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">
                    © 2026 OrmawaCash — Sistem Keuangan Organisasi Mahasiswa
                </small>
            </div>
        </div>
    </div>
</div>
@endsection