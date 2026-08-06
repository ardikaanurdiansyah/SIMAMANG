@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Riwayat Magang</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riwayat as $peserta)
                <tr>
                    <td>{{ $peserta->nama_peserta }}</td>
                    <td>{{ $peserta->divisi->nama_divisi }}</td>
                    <td>{{ $peserta->tanggal_mulai->format('d-m-Y') }}</td>
                    <td>{{ optional($peserta->tanggal_selesai)->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($peserta->status) }}</td>
                    <td>
                        @if ($peserta->status === 'aktif')
                            <form action="{{ route('peserta.selesai', $peserta) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-success">Tandai Selesai</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection