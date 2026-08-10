@extends('layouts.app')

@section('title', 'Dashboard Magang')

@section('content')

@php
    $totalDivisi = $divisis->count();

    $totalKapasitas = $divisis->sum('kapasitas');

    $totalPeserta = $divisis->sum(function ($divisi) {
        return $divisi->pesertaAktif();
    });

    $totalSisa = $totalKapasitas - $totalPeserta;

    $divisiTersedia = $divisis->filter(function ($divisi) {
        return $divisi->kuotaTersedia();
    })->count();
@endphp


{{-- HERO --}}
<div class="hero shadow-sm mb-4">

    <div class="row align-items-center">

        <div class="col-lg-8">

            <span class="badge bg-light text-primary mb-3 px-3 py-2">
                <i class="bi bi-stars me-1"></i>
                Sistem Informasi Magang
            </span>

            <h1 class="fw-bold mb-3">
                Selamat Datang 👋
            </h1>

            <p class="lead mb-0 opacity-75">
                Temukan divisi magang yang sesuai dengan minat
                dan keahlianmu.
            </p>

        </div>

        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

            <a>
                href="{{ route('peserta.create') }}"
                class="btn btn-light btn-lg text-primary fw-semibold shadow-sm"
            >
                <i class="bi bi-pencil-square me-2"></i>
                Daftar Sekarang
            </a>

        </div>

    </div>

</div>


{{-- STATISTIK --}}
<div class="row g-3 mb-5">

    <div class="col-md-6 col-lg-3">

        <div class="card stat-card shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                        <i class="bi bi-diagram-3-fill"></i>
                    </div>

                    <div>
                        <small class="text-muted">
                            Total Divisi
                        </small>

                        <h3 class="fw-bold mb-0">
                            {{ $totalDivisi }}
                        </h3>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-lg-3">

        <div class="card stat-card shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <div>
                        <small class="text-muted">
                            Peserta Aktif
                        </small>

                        <h3 class="fw-bold mb-0">
                            {{ $totalPeserta }}
                        </h3>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-lg-3">

        <div class="card stat-card shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div class="icon-box bg-warning bg-opacity-10 text-warning me-3">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>

                    <div>
                        <small class="text-muted">
                            Sisa Kuota
                        </small>

                        <h3 class="fw-bold mb-0">
                            {{ $totalSisa }}
                        </h3>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-lg-3">

        <div class="card stat-card shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div class="icon-box bg-info bg-opacity-10 text-info me-3">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                    <div>
                        <small class="text-muted">
                            Divisi Tersedia
                        </small>

                        <h3 class="fw-bold mb-0">
                            {{ $divisiTersedia }}
                        </h3>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- JUDUL DIVISI --}}
<div id="pilihan-divisi" class="d-flex justify-content-between align-items-center mb-3">

    <div>
        <h3 class="fw-bold mb-1">
            Pilihan Divisi
        </h3>

        <p class="text-muted mb-0">
            Pilih divisi yang masih memiliki kuota.
        </p>
    </div>

    <span class="badge bg-primary-subtle text-primary px-3 py-2">
        {{ $totalDivisi }} Divisi
    </span>

</div>


{{-- CARD DIVISI --}}
<div class="row g-4">

    @forelse($divisis as $divisi)

        @php
            $pesertaAktif = $divisi->pesertaAktif();
            $sisaKuota = $divisi->kuotaTersisa();

            $persentase = $divisi->kapasitas > 0
                ? ($pesertaAktif / $divisi->kapasitas) * 100
                : 0;
        @endphp


        <div class="col-md-6 col-xl-4">

            <div class="card divisi-card shadow-sm h-100">

                <div class="card-body p-4">

                    {{-- HEADER CARD --}}
                    <div class="d-flex justify-content-between align-items-start mb-3">

                        <div>

                            <span class="badge bg-primary-subtle text-primary">
                                {{ $divisi->kode_divisi }}
                            </span>

                            <h5 class="fw-bold mt-2 mb-0">
                                {{ $divisi->nama_divisi }}
                            </h5>

                        </div>


                        @if($sisaKuota > 0)

                            <span class="badge bg-success-subtle text-success">
                                <i class="bi bi-check-circle me-1"></i>
                                Tersedia
                            </span>

                        @else

                            <span class="badge bg-danger-subtle text-danger">
                                <i class="bi bi-x-circle me-1"></i>
                                Penuh
                            </span>

                        @endif

                    </div>


                    {{-- DESKRIPSI --}}
                    @if($divisi->deskripsi)

                        <p class="text-muted small mb-4">
                            {{ $divisi->deskripsi }}
                        </p>

                    @else

                        <p class="text-muted small mb-4">
                            Informasi divisi magang.
                        </p>

                    @endif


                    {{-- KUOTA --}}
                    <div class="d-flex justify-content-between mb-2">

                        <span class="small text-muted">
                            Kuota terpakai
                        </span>

                        <span class="small fw-bold">
                            {{ $pesertaAktif }} / {{ $divisi->kapasitas }}
                        </span>

                    </div>


                    <div class="progress mb-3">

                        <div
                            class="progress-bar
                            {{ $sisaKuota > 0 ? 'bg-success' : 'bg-danger' }}"
                            role="progressbar"
                            style="width: {{ min($persentase, 100) }}%"
                        ></div>

                    </div>


                    {{-- FOOTER CARD --}}
                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted d-block">
                                Sisa kuota
                            </small>

                            <strong class="fs-5">
                                {{ $sisaKuota }}
                            </strong>

                        </div>


                        @if($sisaKuota > 0)

                            
                                href="{{ route('peserta.create') }}"
                                class="btn btn-primary"
                            >
                                Daftar
                                <i class="bi bi-arrow-right ms-1"></i>
                            </a>

                        @else

                            <button
                                type="button"
                                class="btn btn-secondary"
                                disabled
                            >
                                Penuh
                            </button>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center py-5">

                    <i class="bi bi-inbox display-4 text-muted"></i>

                    <h5 class="fw-bold mt-3">
                        Belum ada divisi
                    </h5>

                    <p class="text-muted">
                        Belum ada data divisi yang tersedia.
                    </p>

                </div>

            </div>

        </div>

    @endforelse

</div>

@endsection