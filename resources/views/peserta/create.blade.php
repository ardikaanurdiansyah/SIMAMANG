@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Tambah Peserta Magang — {{ $divisi->nama_divisi }}</h1>

    <form action="{{ route('peserta.store', $divisi) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Peserta</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Asal Sekolah / Kampus</label>
            <input type="text" name="asal_instansi" class="form-control" placeholder="Contoh: SMKN 1 Sukabumi / Universitas ABC" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email (opsional)</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Data Peserta</button>
    </form>
</div>
@endsection