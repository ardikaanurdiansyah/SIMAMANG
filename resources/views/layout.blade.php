<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistem Magang')</title>

    {{-- Bootstrap CSS --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Tema PLN --}}
    <style>
        :root {
            --bs-primary: #0067AC;
            --bs-primary-rgb: 0, 103, 172;
            --pln-blue-dark: #003D79;
            --pln-yellow: #FFC700;
        }

        .bg-primary {
            background-color: var(--bs-primary) !important;
        }

        .navbar {
            background: linear-gradient(90deg, var(--pln-blue-dark), var(--bs-primary)) !important;
        }

        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .btn-primary:hover {
            background-color: var(--pln-blue-dark);
            border-color: var(--pln-blue-dark);
        }

        .btn-warning {
            background-color: var(--pln-yellow);
            border-color: var(--pln-yellow);
            color: #003D79;
        }

        a.nav-link {
            color: #ffffff !important;
        }

        a.nav-link:hover {
            color: var(--pln-yellow) !important;
        }

        .navbar-brand {
            color: #ffffff !important;
        }

        .card-header.bg-pln {
            background-color: var(--bs-primary);
            color: #fff;
        }

        .border-pln-accent {
            border-left: 4px solid var(--pln-yellow) !important;
        }
    </style>
</head>

<body class="bg-light">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">SIMAMANG</a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Daftar Magang</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('peserta.riwayat') }}">Riwayat</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="container py-4">

        {{-- Flash message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>
            </div>
        @endif

        @yield('content')

    </main>

    {{-- Bootstrap JS --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    @stack('scripts')

</body>
</html>