@extends('layout')

@section('title', 'Detail Peserta Magang')

@section('content')
<div class="mx-auto max-w-6xl px-1 pb-10 sm:px-2 lg:px-0">
    <a href="{{ route('peserta.index') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-sky-700 transition hover:text-sky-900">← Kembali ke daftar</a>

    <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
        <section class="glass-card animate-on-scroll rounded-[32px] p-6 sm:p-8">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <span class="hero-pill">Detail peserta</span>
                    <h1 class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">{{ $peserta->nama }}</h1>
                    <p class="mt-2 text-base leading-7 text-slate-600">Informasi lengkap mengenai peserta magang beserta riwayat kegiatan dan status saat ini.</p>
                </div>
                <div class="{{ $peserta->status === 'Aktif' ? 'status-pill status-pill-active' : 'status-pill status-pill-complete' }}">
                    {{ $peserta->status }}
                </div>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <div class="rounded-[24px] border border-slate-200/80 bg-white/70 p-4">
                    <p class="text-sm font-medium text-slate-500">Nama</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $peserta->nama }}</p>
                </div>
                <div class="rounded-[24px] border border-slate-200/80 bg-white/70 p-4">
                    <p class="text-sm font-medium text-slate-500">Email</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $peserta->email ?? '-' }}</p>
                </div>
                <div class="rounded-[24px] border border-slate-200/80 bg-white/70 p-4">
                    <p class="text-sm font-medium text-slate-500">No. HP</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $peserta->no_hp }}</p>
                </div>
                <div class="rounded-[24px] border border-slate-200/80 bg-white/70 p-4">
                    <p class="text-sm font-medium text-slate-500">Divisi</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $peserta->divisi->nama_divisi }}</p>
                </div>
                <div class="rounded-[24px] border border-slate-200/80 bg-white/70 p-4">
                    <p class="text-sm font-medium text-slate-500">Asal Instansi</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $peserta->asal_instansi }}</p>
                </div>
                <div class="rounded-[24px] border border-slate-200/80 bg-white/70 p-4">
                    <p class="text-sm font-medium text-slate-500">Jurusan</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $peserta->jurusan }}</p>
                </div>
                <div class="rounded-[24px] border border-slate-200/80 bg-white/70 p-4">
                    <p class="text-sm font-medium text-slate-500">Tanggal Mulai</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $peserta->tanggal_mulai->format('d F Y') }}</p>
                </div>
                <div class="rounded-[24px] border border-slate-200/80 bg-white/70 p-4">
                    <p class="text-sm font-medium text-slate-500">Tanggal Selesai</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $peserta->tanggal_selesai->format('d F Y') }}</p>
                </div>
                <div class="rounded-[24px] border border-slate-200/80 bg-white/70 p-4">
                    <p class="text-sm font-medium text-slate-500">Durasi</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $peserta->tanggal_mulai->diffInDays($peserta->tanggal_selesai) }} Hari</p>
                </div>
                @if($peserta->nilai)
                    <div class="rounded-[24px] border border-slate-200/80 bg-white/70 p-4">
                        <p class="text-sm font-medium text-slate-500">Nilai</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $peserta->nilai }}</p>
                    </div>
                @endif
            </div>

            @if($peserta->keterangan)
                <div class="mt-5 rounded-[24px] border border-slate-200/80 bg-slate-50/80 p-4">
                    <p class="text-sm font-medium text-slate-500">Keterangan</p>
                    <p class="mt-2 text-base leading-7 text-slate-700">{{ $peserta->keterangan }}</p>
                </div>
            @endif
        </section>

        <aside class="space-y-6">
            <div class="soft-card animate-on-scroll rounded-[28px] p-6">
                <h2 class="text-lg font-semibold text-slate-900">Ringkasan</h2>
                <div class="mt-4 space-y-3 text-sm text-slate-600">
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-3 py-2">
                        <span>Status</span>
                        <span class="font-semibold text-slate-900">{{ $peserta->status }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-3 py-2">
                        <span>Divisi</span>
                        <span class="font-semibold text-slate-900">{{ $peserta->divisi->nama_divisi }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-3 py-2">
                        <span>Instansi</span>
                        <span class="font-semibold text-slate-900">{{ $peserta->asal_instansi }}</span>
                    </div>
                </div>
            </div>

            <div class="soft-card animate-on-scroll rounded-[28px] p-6">
                <h2 class="text-lg font-semibold text-slate-900">Aksi cepat</h2>
                @if($peserta->status === 'Selesai' && auth()->check() && auth()->user()->is_admin)
                    <div class="mt-4 flex flex-col gap-3">
                        <a href="{{ route('peserta.export-pdf', $peserta->id) }}" class="action-link action-link-success justify-center">📥 Download PDF</a>
                        <a href="{{ route('peserta.preview-pdf', $peserta->id) }}" target="_blank" class="action-link action-link-warning justify-center">👁️ Preview PDF</a>
                    </div>
                @elseif($peserta->status === 'Selesai')
                    <div class="mt-4 rounded-[20px] border border-amber-200 bg-amber-50/80 p-4 text-sm text-amber-700">
                        PDF hanya tersedia untuk administrator.
                    </div>
                @else
                    <div class="mt-4 rounded-[20px] border border-amber-200 bg-amber-50/80 p-4 text-sm text-amber-700">
                        PDF hanya dapat diunduh untuk peserta dengan status <strong>Selesai</strong>.
                    </div>
                @endif
            </div>
        </aside>
    </div>
</div>
@endsection
