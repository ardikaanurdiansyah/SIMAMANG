<?php

namespace Tests\Feature;

use App\Models\Divisi;
use App\Models\PesertaMagang;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PesertaPdfAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_pdf_export(): void
    {
        $divisi = Divisi::create([
            'kode_divisi' => 'ADM',
            'nama_divisi' => 'Administrasi',
            'kapasitas' => 10,
            'deskripsi' => 'Test',
        ]);

        $peserta = PesertaMagang::create([
            'nama' => 'Test Peserta',
            'asal_instansi' => 'Test Instansi',
            'jurusan' => 'Teknik Informatika',
            'no_hp' => '08123456789',
            'email' => 'test@example.com',
            'divisi_id' => $divisi->id,
            'tanggal_mulai' => '2026-01-01',
            'tanggal_selesai' => '2026-02-01',
            'status' => 'Selesai',
        ]);

        $response = $this->get(route('peserta.export-pdf', $peserta->id));

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_non_admin_cannot_access_pdf_export(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $divisi = Divisi::create([
            'kode_divisi' => 'ADM',
            'nama_divisi' => 'Administrasi',
            'kapasitas' => 10,
            'deskripsi' => 'Test',
        ]);

        $peserta = PesertaMagang::create([
            'nama' => 'Test Peserta',
            'asal_instansi' => 'Test Instansi',
            'jurusan' => 'Teknik Informatika',
            'no_hp' => '08123456789',
            'email' => 'test@example.com',
            'divisi_id' => $divisi->id,
            'tanggal_mulai' => '2026-01-01',
            'tanggal_selesai' => '2026-02-01',
            'status' => 'Selesai',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('peserta.export-pdf', $peserta->id));

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_admin_can_access_pdf_export_for_completed_participant(): void
    {
        $user = User::factory()->create([
            'is_admin' => true,
        ]);

        $divisi = Divisi::create([
            'kode_divisi' => 'ADM',
            'nama_divisi' => 'Administrasi',
            'kapasitas' => 10,
            'deskripsi' => 'Test',
        ]);

        $peserta = PesertaMagang::create([
            'nama' => 'Test Peserta',
            'asal_instansi' => 'Test Instansi',
            'jurusan' => 'Teknik Informatika',
            'no_hp' => '08123456789',
            'email' => 'test@example.com',
            'divisi_id' => $divisi->id,
            'tanggal_mulai' => '2026-01-01',
            'tanggal_selesai' => '2026-02-01',
            'status' => 'Selesai',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('peserta.export-pdf', $peserta->id));

        $response->assertStatus(200);
    }
}
