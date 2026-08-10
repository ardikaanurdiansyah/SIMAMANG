@extends('layouts.app')

@section('title', 'Daftar Magang')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow-sm">

            <div class="card-body p-4 p-md-5">

                <h3 class="fw-bold mb-1">
                    Formulir Pendaftaran Magang
                </h3>

                <p class="text-muted mb-4">
                    Lengkapi data berikut untuk mendaftar magang.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('peserta.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="divisi_id" class="form-label">Pilih Divisi</label>
                        <select
                            name="divisi_id"
                            id="divisi_id"
                            class="form-select @error('divisi_id') is-invalid @enderror"
                        >
                            <option value="">-- Pilih Divisi --</option>
                            @foreach ($divisis as $divisi)
                                <option
                                    value="{{ $divisi->id }}"
                                    {{ old('divisi_id') == $divisi->id ? 'selected' : '' }}
                                >
                                    {{ $divisi->nama_divisi }} (Sisa kuota: {{ $divisi->kuotaTersisa() }})
                                </option>
                            @endforeach
                        </select>
                        @error('divisi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}"
                        >
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="asal_instansi" class="form-label">Asal Sekolah / Kampus</label>
                        <input
                            type="text"
                            name="asal_instansi"
                            id="asal_instansi"
                            class="form-control @error('asal_instansi') is-invalid @enderror"
                            value="{{ old('asal_instansi') }}"
                        >
                        @error('asal_instansi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input
                            type="text"
                            name="jurusan"
                            id="jurusan"
                            class="form-control @error('jurusan') is-invalid @enderror"
                            value="{{ old('jurusan') }}"
                        >
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input
                                type="text"
                                name="no_hp"
                                id="no_hp"
                                class="form-control @error('no_hp') is-invalid @enderror"
                                value="{{ old('no_hp') }}"
                            >
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email (opsional)</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                            <input
                                type="date"
                                name="tanggal_mulai"
                                id="tanggal_mulai"
                                class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                value="{{ old('tanggal_mulai') }}"
                            >
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                            <input
                                type="date"
                                name="tanggal_selesai"
                                id="tanggal_selesai"
                                class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                value="{{ old('tanggal_selesai') }}"
                            >
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex justify-content-between mt-4">

                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Daftar Sekarang
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection