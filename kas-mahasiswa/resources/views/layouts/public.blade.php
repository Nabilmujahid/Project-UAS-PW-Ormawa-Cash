<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kas & RAB Mahasiswa - @yield('title')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        
        /* Professional Teal Accents */
        :root {
            --primary-color: #0f766e; /* Teal-700 */
            --primary-hover: #115e59; /* Teal-800 */
            --bg-light: #f0fdfa; /* Teal-50 */
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
            box-shadow: 0 4px 6px -1px rgba(15, 118, 110, 0.2), 0 2px 4px -1px rgba(15, 118, 110, 0.06);
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #f1f5f9;
        }
        .navbar-custom .nav-link {
            font-size: 0.95rem;
            font-weight: 500;
            color: #475569;
            transition: color 0.2s;
        }
        .navbar-custom .nav-link:hover, .navbar-custom .nav-link.active {
            color: var(--primary-color);
        }

        /* Glass Cards */
        .glass-card {
            background: white;
            border-radius: 1rem;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
        }

        /* Hero Section */
        .hero-section {
            padding: 100px 0 60px;
            background: linear-gradient(135deg, var(--bg-light) 0%, #ffffff 100%);
            border-bottom: 1px solid #f1f5f9;
        }

        /* Footer */
        .footer {
            background-color: white;
            border-top: 1px solid #f1f5f9;
            padding: 30px 0;
            margin-top: 60px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary-custom d-flex align-items-center" href="{{ route('home') }}">
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

    <!-- Main Content -->
    <main style="margin-top: 76px; min-height: 70vh;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer text-center text-muted">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Sistem Transparansi Kas & RAB Himpunan Mahasiswa.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
