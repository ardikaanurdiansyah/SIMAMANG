# 📄 Dokumentasi Fitur Export PDF - SIMAMANG

## ✅ Status Implementasi

Semua fitur export PDF telah **berhasil diimplementasikan** dan siap digunakan!

## 📦 Dependencies yang Diinstall

- `barryvdh/laravel-dompdf` v3.1.2
- `dompdf/dompdf` v3.1.6
- Dependency lainnya untuk PDF rendering

## 🗂️ File-File yang Dibuat

### 1. Controller
- **[app/Http/Controllers/PesertaMagangController.php](../app/Http/Controllers/PesertaMagangController.php)**
  - `index()` - Tampilkan daftar peserta
  - `show($id)` - Tampilkan detail peserta
  - `exportPdf($id)` - Download sertifikat 1 peserta
  - `previewPdf($id)` - Preview sertifikat di browser
  - `exportAllPdf()` - Export PDF semua peserta selesai
  - `exportByDivisiPdf($divisi_id)` - Export PDF per divisi

### 2. Views - PDF Templates
- **[resources/views/peserta/pdf.blade.php](../resources/views/peserta/pdf.blade.php)**
  - Template sertifikat individual peserta
  - Format A4 portrait
  - Desain profesional dengan area tanda tangan

- **[resources/views/peserta/pdf-all.blade.php](../resources/views/peserta/pdf-all.blade.php)**
  - Laporan tabel semua peserta selesai
  - Total 8 kolom: No, Nama, Divisi, Asal, Jurusan, Tgl Mulai, Tgl Selesai, Hari

- **[resources/views/peserta/pdf-divisi.blade.php](../resources/views/peserta/pdf-divisi.blade.php)**
  - Laporan peserta per divisi
  - Total 8 kolom dengan data lebih detail (No HP)

### 3. Views - Frontend UI
- **[resources/views/peserta/index.blade.php](../resources/views/peserta/index.blade.php)**
  - Daftar semua peserta dalam tabel
  - Tombol export semua PDF
  - Tombol download/preview PDF untuk peserta selesai

- **[resources/views/peserta/show.blade.php](../resources/views/peserta/show.blade.php)**
  - Detail peserta lengkap
  - Tombol download/preview PDF (hanya untuk status Selesai)

- **[resources/views/layout.blade.php](../resources/views/layout.blade.php)**
  - Master layout dengan navbar dan footer
  - Responsive design dengan Tailwind CSS

### 4. Models
- **[app/Models/PesertaMagang.php](../app/Models/PesertaMagang.php)**
  - Relationships ke Divisi dan User
  - Fillable fields untuk mass assignment
  - Date casting

- **[app/Models/Divisi.php](../app/Models/Divisi.php)**
  - Relationships ke PesertaMagang
  - Method `pesertaAktif()` - hitung peserta aktif
  - Method `kuotaTersisa()` - hitung kuota tersisa

### 5. Routes
- **[routes/web.php](../routes/web.php)**
  - Prefix route `/peserta` dengan group routes
  - 6 route untuk CRUD dan export PDF

## 🔗 Routes & Endpoints

### Peserta List & Detail
| Method | Route | Nama | Fungsi |
|--------|-------|------|--------|
| GET | `/peserta` | `peserta.index` | Daftar peserta |
| GET | `/peserta/{id}` | `peserta.show` | Detail peserta |

### Export PDF
| Method | Route | Nama | Fungsi |
|--------|-------|------|--------|
| GET | `/peserta/{id}/export-pdf` | `peserta.export-pdf` | Download sertifikat PDF |
| GET | `/peserta/{id}/preview-pdf` | `peserta.preview-pdf` | Preview sertifikat PDF |
| GET | `/peserta/export-all/pdf` | `peserta.export-all-pdf` | Export semua peserta selesai |
| GET | `/peserta/export-divisi/{divisi_id}/pdf` | `peserta.export-divisi-pdf` | Export per divisi |

## 📋 Konten PDF yang Dihasilkan

### Sertifikat Individual (pdf.blade.php)
```
┌─────────────────────────────────────┐
│          SIMAMANG                   │
│   SERTIFIKAT PENYELESAIAN MAGANG    │
├─────────────────────────────────────┤
│ Nama: [Nama Peserta]                │
│ Asal Instansi: [Instansi]           │
│ Jurusan: [Jurusan]                  │
│ Divisi: [Nama Divisi]               │
│ Tanggal Mulai: [TGL]                │
│ Tanggal Selesai: [TGL]              │
│ Durasi: [N] Hari                    │
│ Nilai: [Nilai] (jika ada)           │
├─────────────────────────────────────┤
│ [Tanda Tangan Peserta]              │
│ [Tanda Tangan Pembimbing]           │
│ [Tanda Tangan Kepala Divisi]        │
└─────────────────────────────────────┘
```

### Laporan Semua Peserta (pdf-all.blade.php)
- Header: SIMAMANG - LAPORAN DATA PESERTA MAGANG SELESAI
- Summary: Total Peserta, Tanggal Laporan
- Tabel: No, Nama, Divisi, Asal, Jurusan, Tgl Mulai, Tgl Selesai, Durasi

### Laporan Per Divisi (pdf-divisi.blade.php)
- Header: SIMAMANG - LAPORAN DATA PESERTA MAGANG SELESAI (Divisi: XXX)
- Summary: Total Peserta di Divisi, Tanggal Laporan
- Tabel: No, Nama, Asal, Jurusan, No HP, Tgl Mulai, Tgl Selesai, Durasi

## 🚀 Cara Menggunakan

### 1. Akses Halaman Peserta Magang
```
http://localhost:8000/peserta
```

### 2. Download Sertifikat Individual
Klik tombol "⬇️ PDF" pada baris peserta dengan status **Selesai**

### 3. Preview Sertifikat
Klik tombol "👁️ Preview" untuk melihat PDF di browser sebelum download

### 4. Export Semua Peserta
Klik tombol "📄 Export Semua PDF" di halaman peserta

### 5. Export Per Divisi
Gunakan route: `/peserta/export-divisi/{divisi_id}/pdf`

### Contoh dalam Blade View
```blade
{{-- Download sertifikat --}}
<a href="{{ route('peserta.export-pdf', $peserta->id) }}">
    Download PDF
</a>

{{-- Preview sertifikat --}}
<a href="{{ route('peserta.preview-pdf', $peserta->id) }}" target="_blank">
    Preview PDF
</a>

{{-- Export semua peserta --}}
<a href="{{ route('peserta.export-all-pdf') }}">
    Export Semua
</a>

{{-- Export per divisi --}}
<a href="{{ route('peserta.export-divisi-pdf', $divisi->id) }}">
    Export Divisi
</a>
```

## 📊 Fitur-Fitur

✅ **Export Sertifikat**
- Format A4 portrait profesional
- Desain dengan header dan footer
- Area tanda tangan digital
- Nomor sertifikat otomatis

✅ **Export Laporan Tabel**
- Format landscape untuk lebih banyak kolom
- Data tersruktur dalam tabel yang rapih
- Summary/ringkasan data

✅ **Validasi Status**
- Hanya peserta status "Selesai" yang bisa di-export
- Error message jika status masih "Aktif"

✅ **Naming Convention**
- Sertifikat: `sertifikat-[nama-peserta].pdf`
- Laporan semua: `laporan-peserta-magang-[tanggal].pdf`
- Laporan divisi: `laporan-peserta-[nama-divisi]-[tanggal].pdf`

✅ **Styling Profesional**
- CSS dalam PDF (tidak perlu file eksternal)
- Responsive design untuk berbagai ukuran kertas
- Print-friendly styling

✅ **Timestamp**
- Tanggal cetak otomatis
- Format: "d F Y" (misal: "06 August 2026")

## 🔧 Konfigurasi Tambahan (Optional)

### 1. Tambah Field Nilai & Keterangan (Optional)
Jika ingin menambah field `nilai` dan `keterangan`:

```bash
php artisan make:migration add_nilai_keterangan_to_peserta_magangs_table
```

Edit file migration:
```php
public function up()
{
    Schema::table('peserta_magangs', function (Blueprint $table) {
        $table->string('nilai')->nullable()->after('status');
        $table->text('keterangan')->nullable()->after('nilai');
    });
}

public function down()
{
    Schema::table('peserta_magangs', function (Blueprint $table) {
        $table->dropColumn(['nilai', 'keterangan']);
    });
}
```

Jalankan:
```bash
php artisan migrate
```

Update Model PesertaMagang:
```php
protected $fillable = [
    'nama',
    'asal_instansi',
    'jurusan',
    'no_hp',
    'email',
    'divisi_id',
    'tanggal_mulai',
    'tanggal_selesai',
    'status',
    'nilai',           // Tambah
    'keterangan'       // Tambah
];
```

### 2. Kustomisasi Template PDF
Edit file di `resources/views/peserta/`:
- `pdf.blade.php` - untuk sertifikat
- `pdf-all.blade.php` - untuk laporan semua
- `pdf-divisi.blade.php` - untuk laporan per divisi

### 3. Kustomisasi Styling CSS
Buka tag `<style>` di dalam template blade dan modifikasi CSS sesuai kebutuhan

## 📝 Migration Database

Jika ingin menambah field tambahan ke tabel peserta_magangs:

```bash
php artisan make:migration add_pembimbing_to_peserta_magangs_table
```

Contoh penambahan field `pembimbing`:
```php
public function up()
{
    Schema::table('peserta_magangs', function (Blueprint $table) {
        $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
    });
}
```

## 🐛 Troubleshooting

### PDF tidak tergenerate
- Pastikan `barryvdh/laravel-dompdf` sudah terinstall
- Run: `composer install`

### Blade syntax error di PDF
- Gunakan `{{ }}` untuk menampilkan variable
- Gunakan `@if`, `@foreach` untuk logic

### CSS tidak apply di PDF
- Gunakan inline CSS atau `<style>` tag
- Avoid external CSS files
- Use simple CSS rules (no advanced CSS3 features)

### Font tidak terlihat
- Gunakan standard fonts: Arial, Verdana, Times New Roman
- Atau upload custom font ke DOMPDF

## 📞 Support

Untuk informasi lebih lanjut tentang DOMPDF:
- GitHub: https://github.com/barryvdh/laravel-dompdf
- Dokumentasi: https://github.com/dompdf/dompdf

---

**Dibuat pada:** 6 Agustus 2026  
**Last Updated:** 6 Agustus 2026
