@extends('layouts.app')

@section('title', 'Dashboard - SIMAMANG')

@section('content')
    <div class="topbar">
        <h2>Monitoring Kuota Divisi</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    @if (session('success'))
        <p class="alert-success">{{ session('success') }}</p>
    @endif

    <p><a href="{{ route('peserta.create') }}">+ Tambah data peserta</a></p>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Divisi</th>
                <th>Kapasitas</th>
                <th>Terpakai</th>
                <th>Sisa</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($divisis as $divisi)
                <tr>
                    <td>{{ $divisi->kode_divisi }}</td>
                    <td>{{ $divisi->nama_divisi }}</td>
                    <td>{{ $divisi->kapasitas }}</td>
                    <td>{{ $divisi->kuotaTerpakai() }}</td>
                    <td>{{ $divisi->sisaKuota() }}</td>
                    <td>
                        @if ($divisi->kuotaTersedia())
                            <span class="badge-ok">Tersedia</span>
                        @else
                            <span class="badge-full">Penuh</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection