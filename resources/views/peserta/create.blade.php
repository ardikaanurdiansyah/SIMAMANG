@extends('layouts.app')

@section('title', 'Tambah Peserta Magang - SIMAMANG')
@section('body_class', 'narrow')

@section('content')
    <h2>Tambah Data Peserta Magang</h2>
    <p><a href="{{ route('dashboard') }}">&larr; Kembali ke dashboard</a></p>

    @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('peserta.store') }}">
        @csrf
        <div class="form-group">
            <label>Divisi (hanya yang kuotanya masih tersedia)</label><br>
            <select name="divisi_id" required>
                <option value="">-- pilih divisi --</option>
                @forelse ($divisis as $divisi)
                    <option value="{{ $divisi->id }}" {{ old('divisi_id') == $divisi->id ? 'selected' : '' }}>
                        {{ $divisi->nama_divisi }} (sisa {{ $divisi->sisaKuota() }})
                    </option>
                @empty
                    <option value="" disabled>Tidak ada divisi dengan kuota tersedia</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label>Nama peserta</label><br>
            <input type="text" name="nama" value="{{ old('nama') }}" required>
        </div>
        <div class="form-group">
            <label>Asal sekolah / kampus</label><br>
            <input type="text" name="asal_instansi" value="{{ old('asal_instansi') }}" required>
        </div>
        <div class="form-group">
            <label>Jurusan</label><br>
            <input type="text" name="jurusan" value="{{ old('jurusan') }}" required>
        </div>
        <div class="form-group">
            <label>No. HP</label><br>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" required>
        </div>
        <div class="form-group">
            <label>Email (opsional)</label><br>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label>Tanggal mulai</label><br>
            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
        </div>
        <div class="form-group">
            <label>Tanggal selesai (rencana)</label><br>
            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
        </div>
        <button type="submit">Simpan &amp; terima peserta</button>
    </form>
@endsection