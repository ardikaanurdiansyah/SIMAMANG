@extends('layout')

@section('title', 'Riwayat Magang - SIMAMANG')

@section('content')
<div class="mx-auto max-w-7xl px-1 pb-10 sm:px-2 lg:px-0">
    <section class="glass-card animate-on-scroll rounded-[32px] p-6 sm:p-8 lg:p-10">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <span class="hero-pill mb-4">Riwayat</span>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl">Riwayat Magang</h1>
                <p class="mt-4 text-lg leading-8 text-slate-600">Daftar peserta yang telah menyelesaikan program magang.</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('peserta.export-all-pdf') }}" class="action-link action-link-success">📄 Export PDF</a>
                    @endif
                @endauth
            </div>
        </div>
    </section>

    <section class="mt-8 rounded-[32px] border border-slate-200/80 bg-white/80 p-4 shadow-sm backdrop-blur sm:p-6">
        <div class="mt-2 overflow-hidden rounded-[24px] border border-slate-200 bg-white">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Asal Sekolah/Kampus</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Jurusan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Divisi</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Mulai</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Selesai</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse ($riwayat as $peserta)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm font-semibold text-slate-900">{{ $peserta->nama }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $peserta->asal_instansi }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $peserta->jurusan }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $peserta->divisi->nama_divisi }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $peserta->tanggal_mulai->format('d-m-Y') }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ optional($peserta->tanggal_selesai)->format('d-m-Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if ($peserta->status === 'Aktif')
                                    <span class="status-pill status-pill-active">Aktif</span>
                                @else
                                    <span class="status-pill status-pill-complete">Selesai</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700">
                                @if ($peserta->status === 'Aktif')
                                    <form action="{{ route('peserta.selesai', $peserta) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="action-link action-link-success">Tandai Selesai</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada riwayat magang</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection