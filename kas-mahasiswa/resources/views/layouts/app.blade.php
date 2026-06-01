<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrmawaCash - @yield('title', 'Sistem Manajemen Keuangan Organisasi Mahasiswa')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #002B4A;
            --primary-dark: #001A2E;
            --primary-soft: #96AAD1;
            --accent-soft: #EEF3FC;
            --bg: #F7F9FD;
            --text-dark: #0F172A;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --danger-soft: #FFE8E8;
            --danger: #FF5A5F;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: #334155;
            font-size: 0.9rem;
        }

        .sidebar {
            width: 265px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid #E8EEF7;
            padding: 24px 18px;
            display: flex;
            flex-direction: column;
            box-shadow: 8px 0 28px rgba(15, 23, 42, 0.04);
        }

        .brand-box {
            padding: 4px 6px 22px;
            margin-bottom: 18px;
            border-bottom: 1px solid var(--border);
        }

        .brand-title {
            margin: 0;
            color: #002B4A;
            font-weight: 800;
            font-size: 1.25rem;
        }

        .brand-title i {
            color: #96AAD1;
        }

        .brand-subtitle {
            margin: 6px 0 0;
            color: var(--text-muted);
            font-size: 0.78rem;
            line-height: 1.5;
        }

        .sidebar a:hover {
            color: #002B4A;
            background: #EEF3FC;
            border-color: #D9E3F5;
            transform: translateX(3px);
        }

        .sidebar a:hover i {
            color: #5D84E8;
        }

        .sidebar a.active {
            color: #002B4A;
            background: #DDE7FB;
            border: 1px solid #D2DFF8;
            box-shadow: none;
        }

        .sidebar a.active i {
            color: #5D84E8;
        }

        .topbar {
            background: #ffffff;
            border: 1px solid #E8EEF7;
            border-radius: 24px;
            padding: 20px 24px;
            margin-bottom: 26px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.04);
            position: relative;
            overflow: hidden;
        }

        .topbar::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 7px;
            height: 100%;
            background: linear-gradient(180deg, #96AAD1, #002B4A);
        }

        .user-pill {
            background: #EEF3FC;
            border: 1px solid #D9E3F5;
        }

        .user-pill i {
            color: #5D84E8;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4F7EF7, #002B4A);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3B6CF0, #001A2E);
        }

        .table-hover tbody tr:hover {
            background-color: #F7F9FD;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #96AAD1;
            box-shadow: 0 0 0 0.2rem rgba(150, 170, 209, 0.18);
        }
    </style>
</head>

<body>
    @auth
        <div class="sidebar">
            <div class="brand-box">
                <h5 class="brand-title">
                    <i class="bi bi-cash-coin me-2"></i>OrmawaCash
                </h5>
                <p class="brand-subtitle">Sistem Keuangan Organisasi Mahasiswa</p>
            </div>

            <div class="sidebar-menu">
                <div class="sidebar-section-label">Menu</div>

                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>

                @if(Auth::user()->role === 'bendahara')
                    <a href="{{ route('anggota.index') }}" class="{{ request()->routeIs('anggota.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> Data Pengurus
                    </a>

                    <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <i class="bi bi-tags me-2"></i> Kategori Transaksi
                    </a>

                    <a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                        <i class="bi bi-wallet2 me-2"></i> Transaksi Kas
                    </a>

                    <a href="{{ route('pengajuan-rab.index') }}" class="{{ request()->routeIs('pengajuan-rab.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text me-2"></i> Pengajuan RAB Masuk
                    </a>
                @endif

                @if(Auth::user()->role === 'ketua')
                    <a href="{{ route('pengajuan-rab.index') }}" class="{{ request()->routeIs('pengajuan-rab.*') ? 'active' : '' }}">
                        <i class="bi bi-check2-square me-2"></i> Persetujuan RAB
                    </a>
                @endif

                @if(Auth::user()->role === 'pengurus')
                    <a href="{{ route('pengajuan-rab.create') }}" class="{{ request()->routeIs('pengajuan-rab.create') ? 'active' : '' }}">
                        <i class="bi bi-plus-circle me-2"></i> Ajukan RAB
                    </a>

                    <a href="{{ route('pengajuan-rab.index') }}" class="{{ request()->routeIs('pengajuan-rab.index') ? 'active' : '' }}">
                        <i class="bi bi-clock-history me-2"></i> Status Pengajuan
                    </a>
                @endif
            </div>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="main-content with-sidebar">
            <div class="topbar d-flex justify-content-between align-items-center">
                <h5 class="page-title">@yield('title')</h5>

                <div class="user-pill">
                    <i class="bi bi-person-circle me-1"></i>
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>({{ ucfirst(Auth::user()->role) }})</span>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    @else
        <div class="main-content guest-content">
            @yield('content')
        </div>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>