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
            --primary: #0f766e;
            --primary-dark: #115e59;
            --primary-soft: #ccfbf1;
            --bg: #f3f7f8;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --danger-soft: #fee2e2;
            --danger: #dc2626;
        }

        body {
            font-family: 'Inter', poppins;
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
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 55%, #ecfdf5 100%);
            border-right: 1px solid var(--border);
            padding: 24px 18px;
            display: flex;
            flex-direction: column;
            box-shadow: 8px 0 28px rgba(15, 23, 42, 0.06);
        }

        .brand-box {
            padding: 4px 6px 22px;
            margin-bottom: 18px;
            border-bottom: 1px solid var(--border);
        }

        .brand-title {
            margin: 0;
            color: var(--primary-dark);
            font-weight: 800;
            font-size: 1.25rem;
        }

        .brand-title i {
            color: var(--primary);
        }

        .brand-subtitle {
            margin: 6px 0 0;
            color: var(--text-muted);
            font-size: 0.78rem;
            line-height: 1.5;
        }

        .sidebar-section-label {
            font-size: 0.68rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 0 14px;
            margin-bottom: 10px;
        }

        .sidebar-menu {
            flex: 1;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #475569;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .sidebar a i {
            width: 22px;
            font-size: 1rem;
            color: #64748b;
        }

        .sidebar a:hover {
            color: var(--primary-dark);
            background: #ecfdf5;
            border-color: #99f6e4;
            transform: translateX(3px);
        }

        .sidebar a:hover i {
            color: var(--primary-dark);
        }

        .sidebar a.active {
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 12px 24px rgba(15, 118, 110, 0.22);
        }

        .sidebar a.active i {
            color: white;
        }

        .sidebar-footer {
            padding-top: 18px;
            border-top: 1px solid var(--border);
        }

        .logout-btn {
            width: 100%;
            border: none;
            background: var(--danger-soft);
            color: var(--danger);
            padding: 12px 15px;
            border-radius: 14px;
            font-weight: 700;
            text-align: left;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: #fecaca;
            color: #991b1b;
        }

        .main-content {
            min-height: 100vh;
            padding: 28px 34px;
        }

        .main-content.with-sidebar {
            margin-left: 265px;
        }

        .main-content.guest-content {
            margin-left: 0;
            padding: 0;
        }

        .topbar {
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 20px 24px;
            margin-bottom: 26px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
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
            background: linear-gradient(180deg, var(--primary), var(--primary-dark));
        }

        .page-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text-dark);
            margin: 0;
        }

        .user-pill {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 8px 14px;
            color: #475569;
            font-size: 0.84rem;
        }

        .user-pill i {
            color: var(--primary);
        }

        .user-pill strong {
            color: var(--text-dark);
        }

        .card {
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: 0 14px 32px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .card-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
        }

        .card-body {
            padding: 22px;
        }

        /* =========================
        BUTTON
        ========================= */

        .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .btn-sm {
            padding: 4px 10px;
            font-size: 0.78rem;
            line-height: 1.3;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), #134e4a);
        }

/* tombol aksi tabel */
.table-action-btn {
    padding: 4px 8px !important;
    font-size: 0.75rem !important;
    border-radius: 8px !important;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.table-action-btn i {
    font-size: 0.72rem !important;
}

.table td .btn {
    margin: 2px;
}
        .table {
            margin-bottom: 0;
            font-size: 0.88rem;
        }

        .table thead th {
            background: #f8fafc;
            color: #0f172a;
            font-weight: 800;
            border-bottom: 1px solid var(--border);
            padding: 14px 12px;
        }

        .table tbody td {
            padding: 14px 12px;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f0fdfa;
        }

        .alert {
            border-radius: 16px;
            border: none;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
        }

        .form-control,
        .form-select {
            border-radius: 13px;
            padding: 10px 12px;
            border-color: #cbd5e1;
            font-size: 0.9rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(15, 118, 110, 0.14);
        }

        .form-label {
            font-weight: 700;
            color: #334155;
            margin-bottom: 7px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }

            .main-content.with-sidebar {
                margin-left: 0;
            }

            .main-content {
                padding: 20px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 12px;
            }
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