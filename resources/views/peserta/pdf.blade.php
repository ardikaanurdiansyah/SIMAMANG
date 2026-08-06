<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Magang - {{ $peserta->nama }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            background: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #003366;
            padding-bottom: 20px;
        }
        
        .logo-area {
            font-size: 24px;
            font-weight: bold;
            color: #003366;
            margin-bottom: 10px;
        }
        
        .title {
            font-size: 28px;
            font-weight: bold;
            color: #003366;
            margin: 30px 0;
            text-decoration: underline;
        }
        
        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .content {
            margin: 30px 0;
            line-height: 1.8;
        }
        
        .content p {
            margin-bottom: 15px;
            text-align: justify;
            font-size: 12px;
        }
        
        .info-box {
            background: #f9f9f9;
            border-left: 4px solid #003366;
            padding: 15px;
            margin: 20px 0;
            font-size: 12px;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 10px;
        }
        
        .info-label {
            font-weight: bold;
            width: 120px;
            color: #003366;
        }
        
        .info-value {
            flex: 1;
        }
        
        .signature-area {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
            font-size: 12px;
        }
        
        .signature-block {
            text-align: center;
            width: 30%;
        }
        
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 40px;
            padding-top: 5px;
        }
        
        .footer {
            text-align: center;
            font-size: 10px;
            color: #999;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        
        .stamp {
            position: absolute;
            right: 40px;
            top: 200px;
            opacity: 0.1;
            font-size: 48px;
            color: #003366;
            transform: rotate(-45deg);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 11px;
        }
        
        th {
            background: #003366;
            color: white;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="stamp">✓</div>
        
        <div class="header">
            <div class="logo-area">SIMAMANG</div>
            <div class="subtitle">Sistem Manajemen Data Magang</div>
        </div>
        
        <div class="title">SERTIFIKAT PENYELESAIAN MAGANG</div>
        
        <div class="content">
            <p style="text-align: center; margin-bottom: 20px;">
                <strong>Nomor: {{ $peserta->id }}/SIMAMANG/{{ now()->format('Y') }}</strong>
            </p>
            
            <p>
                Dengan ini kami menyatakan bahwa:
            </p>
            
            <div class="info-box">
                <div class="info-row">
                    <div class="info-label">Nama</div>
                    <div class="info-value">: <strong>{{ $peserta->nama }}</strong></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Asal Instansi</div>
                    <div class="info-value">: {{ $peserta->asal_instansi }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jurusan</div>
                    <div class="info-value">: {{ $peserta->jurusan }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Divisi</div>
                    <div class="info-value">: {{ $peserta->divisi->nama_divisi }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Mulai</div>
                    <div class="info-value">: {{ $peserta->tanggal_mulai->format('d F Y') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Selesai</div>
                    <div class="info-value">: {{ $peserta->tanggal_selesai->format('d F Y') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Durasi</div>
                    <div class="info-value">: {{ $peserta->tanggal_mulai->diffInDays($peserta->tanggal_selesai) }} Hari</div>
                </div>
                @if($peserta->nilai)
                <div class="info-row">
                    <div class="info-label">Nilai</div>
                    <div class="info-value">: {{ $peserta->nilai }}</div>
                </div>
                @endif
            </div>
            
            <p>
                telah menyelesaikan program magang di <strong>{{ $peserta->divisi->nama_divisi }}</strong> dengan baik dan sungguh-sungguh. 
                Peserta telah menunjukkan kinerja yang memuaskan dan memenuhi semua persyaratan yang telah ditentukan.
            </p>
            
            @if($peserta->keterangan)
            <p>
                <strong>Keterangan:</strong> {{ $peserta->keterangan }}
            </p>
            @endif
            
            <p>
                Demikian sertifikat ini diberikan sebagai bukti telah menyelesaikan program magang, semoga dapat bermanfaat bagi pengembangan karir peserta di masa yang akan datang.
            </p>
        </div>
        
        <div class="signature-area">
            <div class="signature-block">
                <strong>Peserta Magang</strong>
                <div class="signature-line">
                    <p style="margin-top: 5px;">{{ $peserta->nama }}</p>
                </div>
            </div>
            
            <div class="signature-block">
                <strong>Pembimbing</strong>
                <div class="signature-line">
                    <p style="margin-top: 5px;">( ________________ )</p>
                </div>
            </div>
            
            <div class="signature-block">
                <strong>Kepala Divisi</strong>
                <div class="signature-line">
                    <p style="margin-top: 5px;">( ________________ )</p>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>Dicetak pada: {{ $tanggal_cetak }}</p>
            <p>Sistem Informasi Manajemen Data Magang © {{ now()->year }}</p>
        </div>
    </div>
</body>
</html>
