<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peserta Magang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #003366;
            padding-bottom: 20px;
        }
        
        .logo-area {
            font-size: 20px;
            font-weight: bold;
            color: #003366;
            margin-bottom: 5px;
        }
        
        .title {
            font-size: 18px;
            font-weight: bold;
            color: #003366;
            margin: 15px 0;
        }
        
        .info-header {
            font-size: 12px;
            color: #666;
            margin: 10px 0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        thead {
            background: #003366;
            color: white;
        }
        
        th {
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
            border: 1px solid #003366;
        }
        
        td {
            padding: 10px 8px;
            border: 1px solid #ddd;
            font-size: 11px;
        }
        
        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }
        
        tbody tr:hover {
            background: #f0f5ff;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        
        .summary {
            background: #f0f5ff;
            border: 1px solid #003366;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 12px;
        }
        
        .summary-item {
            display: inline-block;
            margin-right: 30px;
        }
        
        .summary-label {
            color: #666;
            font-size: 11px;
        }
        
        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #003366;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .status-selesai {
            background: #cfe2ff;
            color: #084298;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-area">SIMAMANG</div>
        <div class="title">LAPORAN DATA PESERTA MAGANG SELESAI</div>
        <div class="info-header">
            Sistem Manajemen Data Magang | Dicetak: {{ $tanggal_cetak }}
        </div>
    </div>
    
    <div class="summary">
        <div class="summary-item">
            <div class="summary-label">Total Peserta Selesai</div>
            <div class="summary-value">{{ $total_peserta }}</div>
        </div>
        <div class="summary-item">
            <div class="summary-label">Tanggal Laporan</div>
            <div class="summary-value">{{ $tanggal_cetak }}</div>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 18%;">Nama</th>
                <th style="width: 15%;">Divisi</th>
                <th style="width: 12%;">Asal Instansi</th>
                <th style="width: 12%;">Jurusan</th>
                <th style="width: 10%;">Tanggal Mulai</th>
                <th style="width: 10%;">Tanggal Selesai</th>
                <th style="width: 8%;">Hari</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peserta as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $p->nama }}</strong></td>
                <td>{{ $p->divisi->nama_divisi }}</td>
                <td>{{ $p->asal_instansi }}</td>
                <td>{{ $p->jurusan }}</td>
                <td>{{ $p->tanggal_mulai->format('d/m/Y') }}</td>
                <td>{{ $p->tanggal_selesai->format('d/m/Y') }}</td>
                <td class="text-center">{{ $p->tanggal_mulai->diffInDays($p->tanggal_selesai) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; color: #999;">Tidak ada data peserta</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        <p>Laporan ini dicetak otomatis oleh Sistem Informasi Manajemen Data Magang</p>
        <p>© {{ now()->year }} - Hak Cipta Dilindungi</p>
    </div>
</body>
</html>
