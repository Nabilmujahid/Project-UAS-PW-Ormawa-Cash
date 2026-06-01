<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kas & RAB Mahasiswa - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fdf6f9;
            color: #3d2b47;
        }

        :root {
            --primary-color: #e879a0;
            --primary-hover: #c4587e;
            --bg-light: #fce8f1;
        }

        .text-primary-custom { color: var(--primary-color) !important; }
        .bg-primary-custom { background-color: var(--primary-color) !important; color: white !important; }
        .bg-light-custom { background-color: var(--bg-light) !important; }

        .btn-primary-custom {
            background-color: var(--primary-color);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(232, 121, 160, 0.2), 0 2px 4px -1px rgba(232, 121, 160, 0.1);
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #f2daea;
        }
        .navbar-custom .nav-link {
            font-size: 0.95rem;
            font-weight: 500;
            color: #7a5a72;
            transition: color 0.2s;
        }
        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: var(--primary-color);
        }
        .navbar-custom .navbar-brand {
            color: var(--primary-hover) !important;
            font-weight: 800;
        }
        .navbar-custom .navbar-brand i {
            color: var(--primary-color);
        }

        .glass-card {
            background: white;
            border-radius: 1rem;
            border: 1px solid #f2daea;
            box-shadow: 0 4px 6px -1px rgba(232, 121, 160, 0.06), 0 2px 4px -1px rgba(232, 121, 160, 0.04);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(232, 121, 160, 0.1), 0 4px 6px -2px rgba(232, 121, 160, 0.06);
        }

        .hero-section {
            padding: 100px 0 60px;
            background: var(--bg-light);
            border-bottom: 1px solid #f2daea;
        }

        .footer {
            background-color: white;
            border-top: 1px solid #f2daea;
            padding: 30px 0;
            margin-top: 60px;
            font-size: 0.9rem;
            color: #9d84a8;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
                <i class="bi bi-wallet2 me-2"></i> OrmawaCash
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    @auth
                        <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                            <a class="btn btn-outline-secondary btn-sm rounded-pill px-4" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item ms-lg-3 mt-3 mt-lg-0 mb-2 mb-lg-0">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-primary-custom btn-sm rounded-pill px-4 shadow-sm" href="{{ route('ajukan-rab') }}">Ajukan RAB</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main style="margin-top: 76px; min-height: 70vh;">
        @yield('content')
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Sistem Transparansi Kas & RAB Himpunan Mahasiswa.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>