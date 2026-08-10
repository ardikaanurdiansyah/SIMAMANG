@extends('layouts.app')

@section('title', 'Daftar Magang')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h3 class="fw-bold mb-1">
                    Pendaftaran Magang
                </h3>

                <p class="text-muted mb-4">
                    Silakan lengkapi data diri dan pilih divisi magang.
                </p>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan:</strong>

                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('peserta.store') }}"
                    method="POST"
                >

                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Divisi
                        </label>

                        <select
                            name="divisi_id"
                            class="form-select @error('divisi_id') is-invalid @enderror"
                            required
                        >
                            <option value="">
                                -- Pilih Divisi --
                            </option>

                            @foreach($divisis as $divisi)

                                <option
                                    value="{{ $divisi->id }}"
                                    {{ old('divisi_id') == $divisi->id ? 'selected' : '' }}
                                >
                                    {{ $divisi->nama_divisi }}
                                    (Sisa {{ $divisi->kuotaTersisa() }})
                                </option>

                            @endforeach
                        </select>

                        @error('divisi_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}"
                            required
                        >

                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Asal Instansi
                        </label>

                        <input
                            type="text"
                            name="asal_instansi"
                            class="form-control @error('asal_instansi') is-invalid @enderror"
                            value="{{ old('asal_instansi') }}"
                            required
                        >

                        @error('asal_instansi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Jurusan
                        </label>

                        <input
                            type="text"
                            name="jurusan"
                            class="form-control @error('jurusan') is-invalid @enderror"
                            value="{{ old('jurusan') }}"
                            required
                        >

                        @error('jurusan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            No. HP
                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            class="form-control @error('no_hp') is-invalid @enderror"
                            value="{{ old('no_hp') }}"
                            required
                        >

                        @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                        >

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="tanggal_mulai"
                                class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                value="{{ old('tanggal_mulai') }}"
                                required
                            >

                            @error('tanggal_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                name="tanggal_selesai"
                                class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                value="{{ old('tanggal_selesai') }}"
                                required
                            >

                            @error('tanggal_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    <div class="d-flex justify-content-between mt-4">

                        <a
                            href="{{ route('dashboard') }}"
                            class="btn btn-secondary"
                        >
                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >
                            Daftar Magang
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection