<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIMAMANG - Sistem Manajemen Magang')</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            :root {
                color-scheme: light;
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            }

            body {
                min-height: 100vh;
                background:
                    radial-gradient(circle at top left, rgba(14, 165, 233, 0.16), transparent 32%),
                    linear-gradient(135deg, #f8fbff 0%, #eef4ff 45%, #f8fafc 100%);
                color: #0f172a;
            }

            ::selection {
                background: rgba(14, 165, 233, 0.3);
                color: #0f172a;
            }

            .app-shell {
                min-height: 100vh;
                background:
                    radial-gradient(circle at top right, rgba(59, 130, 246, 0.16), transparent 24%),
                    linear-gradient(135deg, #f8fbff 0%, #eef4ff 50%, #f8fafc 100%);
            }

            .glass-card {
                border: 1px solid rgba(255, 255, 255, 0.7);
                background: rgba(255, 255, 255, 0.82);
                box-shadow: 0 20px 70px -24px rgba(15, 23, 42, 0.28);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
            }

            .soft-card {
                border: 1px solid rgba(148, 163, 184, 0.22);
                background: rgba(255, 255, 255, 0.95);
                box-shadow: 0 14px 40px -28px rgba(15, 23, 42, 0.24);
            }

            .hero-pill {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                border-radius: 9999px;
                border: 1px solid rgba(14, 165, 233, 0.18);
                background: rgba(224, 242, 254, 0.7);
                color: #0369a1;
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .metric-chip {
                border-radius: 9999px;
                border: 1px solid rgba(148, 163, 184, 0.2);
                background: rgba(248, 250, 252, 0.95);
                color: #0f172a;
                padding: 0.5rem 0.8rem;
                font-size: 0.8rem;
                font-weight: 600;
            }

            .action-link {
                display: inline-flex;
                align-items: center;
                gap: 0.45rem;
                border-radius: 9999px;
                padding: 0.65rem 0.95rem;
                font-size: 0.9rem;
                font-weight: 600;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
                text-decoration: none;
            }

            .action-link:hover {
                transform: translateY(-1px);
            }

            .action-link-primary {
                background: linear-gradient(135deg, #2563eb, #0ea5e9);
                color: white;
                box-shadow: 0 12px 24px -16px rgba(37, 99, 235, 0.8);
            }

            .action-link-secondary {
                background: rgba(248, 250, 252, 0.95);
                color: #334155;
                border: 1px solid rgba(148, 163, 184, 0.24);
            }

            .action-link-success {
                background: rgba(220, 252, 231, 0.9);
                color: #166534;
                border: 1px solid rgba(34, 197, 94, 0.18);
            }

            .action-link-warning {
                background: rgba(254, 243, 199, 0.9);
                color: #92400e;
                border: 1px solid rgba(245, 158, 11, 0.18);
            }

            .status-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 9999px;
                padding: 0.4rem 0.8rem;
                font-size: 0.75rem;
                font-weight: 700;
                letter-spacing: 0.02em;
            }

            .status-pill-active {
                background: rgba(220, 252, 231, 0.95);
                color: #166534;
            }

            .status-pill-complete {
                background: rgba(224, 242, 254, 0.95);
                color: #075985;
            }

            .animate-on-scroll {
                opacity: 0;
                transform: translateY(18px);
                transition: opacity 0.5s ease, transform 0.5s ease;
            }

            .animate-on-scroll.is-visible {
                opacity: 1;
                transform: translateY(0);
            }

            .table-row-hidden {
                display: none !important;
            }
        </style>
    @endif
</head>
<body class="app-shell">
    <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-4 sm:px-6 lg:px-8">
        <nav class="glass-card mb-6 rounded-[28px] px-5 py-4 sm:px-7">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <a href="{{ route('peserta.index') }}" class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-sky-600 text-lg font-bold text-white shadow-lg">
                        S
                    </div>
                    <div>
                        <p class="text-lg font-semibold text-slate-900">SIMAMANG</p>
                        <p class="text-sm text-slate-500">Sistem Manajemen Magang</p>
                    </div>
                </a>

                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('peserta.index') }}" class="action-link action-link-secondary">Peserta</a>
                    <a href="#" class="action-link action-link-secondary">Divisi</a>
                    @auth
                        <span class="metric-chip">{{ auth()->user()->name ?? 'Admin' }}</span>
                    @else
                        <span class="metric-chip">Pengunjung</span>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="flex-1">
            @if($errors->any())
                <div class="mx-auto mb-6 max-w-7xl">
                    @foreach($errors->all() as $error)
                        <div class="mb-3 rounded-2xl border border-red-200 bg-red-50/90 p-4 text-sm text-red-700">
                            <p>❌ {{ $error }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="mx-auto mb-6 max-w-7xl">
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50/90 p-4 text-sm text-emerald-700">
                        <p>✅ {{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-auto mb-6 max-w-7xl">
                    <div class="rounded-2xl border border-red-200 bg-red-50/90 p-4 text-sm text-red-700">
                        <p>❌ {{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="mt-8 rounded-[28px] border border-slate-200/80 bg-white/70 px-6 py-6 text-center text-sm text-slate-600 shadow-sm">
            <p>&copy; {{ now()->year }} SIMAMANG - Sistem Manajemen Data Magang</p>
        </footer>
    </div>
</body><script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('[data-search-input]');
    const statusSelect = document.querySelector('[data-filter-status]');
    const rows = Array.from(document.querySelectorAll('[data-search-row]'));

    const refreshRows = () => {
        const query = (searchInput?.value ?? '').toLowerCase().trim();
        const status = (statusSelect?.value ?? 'all').toLowerCase();

        rows.forEach((row) => {
            const haystack = [
                row.dataset.name ?? '',
                row.dataset.divisi ?? '',
                row.dataset.instansi ?? '',
                row.dataset.status ?? '',
            ].join(' ');

            const matchesQuery = haystack.includes(query);
            const matchesStatus = status === 'all' || (row.dataset.status ?? '') === status;
            row.classList.toggle('table-row-hidden', !(matchesQuery && matchesStatus));
        });
    };

    searchInput?.addEventListener('input', refreshRows);
    statusSelect?.addEventListener('change', refreshRows);
    refreshRows();

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.animate-on-scroll').forEach((element) => observer.observe(element));
});
</script></html>
