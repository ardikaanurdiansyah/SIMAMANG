@extends('layout')

@section('title', 'Daftar Peserta Magang')

@section('content')
<div class="mx-auto max-w-7xl px-1 pb-10 sm:px-2 lg:px-0">
    <section class="glass-card animate-on-scroll rounded-[32px] p-6 sm:p-8 lg:p-10">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <span class="hero-pill mb-4">Sistem Magang Modern</span>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl">Kelola peserta magang dengan pengalaman yang lebih jelas dan cepat.</h1>
                <p class="mt-4 text-lg leading-8 text-slate-600">Pantau daftar peserta, status magang, dan akses export PDF dari satu dashboard yang nyaman untuk admin.</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('peserta.export-all-pdf') }}" class="action-link action-link-success">📄 Export Semua PDF</a>
                    @endif
                @endauth
                <a href="#" class="action-link action-link-secondary">📊 Ringkasan</a>
            </div>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <div class="soft-card rounded-[24px] p-5">
                <p class="text-sm font-medium text-slate-500">Total peserta</p>
                <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $peserta->count() }}</p>
            </div>
            <div class="soft-card rounded-[24px] p-5">
                <p class="text-sm font-medium text-slate-500">Aktif saat ini</p>
                <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $peserta->where('status', 'Aktif')->count() }}</p>
            </div>
            <div class="soft-card rounded-[24px] p-5">
                <p class="text-sm font-medium text-slate-500">Selesai</p>
                <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $peserta->where('status', 'Selesai')->count() }}</p>
            </div>
        </div>
    </section>

    <section class="mt-8 rounded-[32px] border border-slate-200/80 bg-white/80 p-4 shadow-sm backdrop-blur sm:p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">Daftar Peserta</h2>
                <p class="text-sm text-slate-500">Cari berdasarkan nama, divisi, atau asal instansi.</p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <label class="relative block">
                    <span class="sr-only">Cari peserta</span>
                    <input
                        type="text"
                        data-search-input
                        placeholder="Cari peserta..."
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 pr-10 text-sm shadow-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100 sm:w-72"
                    >
                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">🔎</span>
                </label>

                <select
                    data-filter-status
                    class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 shadow-sm outline-none transition focus:border-sky-500"
                >
                    <option value="all">Semua status</option>
                    <option value="aktif">Aktif</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
        </div>

        @if($peserta->isEmpty())
            <div class="mt-6 rounded-[24px] border border-dashed border-slate-300 bg-slate-50/80 p-8 text-center text-slate-600">
                <p class="font-semibold text-slate-800">Belum ada data peserta magang</p>
                <p class="mt-2 text-sm">Tambahkan data peserta untuk mulai mengelola aktivitas magang.</p>
            </div>
        @else
            <div class="mt-6 overflow-hidden rounded-[24px] border border-slate-200 bg-white">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Divisi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Asal Instansi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($peserta as $index => $p)
                            <tr
                                class="transition hover:bg-slate-50"
                                data-search-row
                                data-name="{{ strtolower($p->nama) }}"
                                data-divisi="{{ strtolower($p->divisi->nama_divisi ?? '') }}"
                                data-instansi="{{ strtolower($p->asal_instansi ?? '') }}"
                                data-status="{{ strtolower($p->status) }}"
                            >
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-slate-900">{{ $p->nama }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $p->divisi->nama_divisi }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $p->asal_instansi }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($p->status === 'Aktif')
                                        <span class="status-pill status-pill-active">Aktif</span>
                                    @else
                                        <span class="status-pill status-pill-complete">Selesai</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-700">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('peserta.show', $p->id) }}" class="action-link action-link-secondary">Lihat</a>
                                        @if($p->status === 'Selesai' && auth()->check() && auth()->user()->is_admin)
                                            <a href="{{ route('peserta.export-pdf', $p->id) }}" class="action-link action-link-success">PDF</a>
                                            <a href="{{ route('peserta.preview-pdf', $p->id) }}" target="_blank" class="action-link action-link-warning">Preview</a>
                                        @elseif($p->status !== 'Selesai')
                                            <span class="metric-chip">Dalam proses</span>
                                        @else
                                            <span class="metric-chip">Admin only</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-500">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </section>
</div>
@endsection
