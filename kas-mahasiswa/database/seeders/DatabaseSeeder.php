<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Anggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users
        User::create([
            'name' => 'Bendahara Umum',
            'email' => 'bendahara@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'bendahara',
        ]);

        User::create([
            'name' => 'Ketua Umum',
            'email' => 'ketua@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'ketua',
        ]);

        User::create([
            'name' => 'Pengurus / PJ Kegiatan',
            'email' => 'pengurus@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pengurus',
        ]);

        // 2. Seed Departemen
        $departemens = [
            ['nama_departemen' => 'Kewirausahaan', 'deskripsi' => 'Fokus pada pendanaan mandiri'],
            ['nama_departemen' => 'Kesekretariatan', 'deskripsi' => 'Fokus pada administrasi'],
            ['nama_departemen' => 'Humas', 'deskripsi' => 'Fokus pada hubungan masyarakat'],
            ['nama_departemen' => 'Kaderisasi', 'deskripsi' => 'Fokus pada pengembangan anggota'],
            ['nama_departemen' => 'Rinoya', 'deskripsi' => 'Fokus pada riset dan inovasi karya'],
            ['nama_departemen' => 'Intelektual', 'deskripsi' => 'Fokus pada kajian dan akademik'],
        ];

        foreach ($departemens as $dept) {
            \App\Models\Departemen::create($dept);
        }

        // 3. Seed Kategori
        $kategoris = [
            ['nama_kategori' => 'Iuran Anggota', 'tipe' => 'pemasukan'],
            ['nama_kategori' => 'Sponsor', 'tipe' => 'pemasukan'],
            ['nama_kategori' => 'Donasi', 'tipe' => 'pemasukan'],
            ['nama_kategori' => 'Dana Kegiatan', 'tipe' => 'pengeluaran'],
            ['nama_kategori' => 'Konsumsi', 'tipe' => 'pengeluaran'],
            ['nama_kategori' => 'Transportasi', 'tipe' => 'pengeluaran'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }

        // 4. Seed Anggota
        $anggotas = [
            ['nama' => 'Budi Santoso', 'nim' => '10121001', 'jabatan' => 'Ketua', 'no_hp' => '081234567890', 'alamat' => 'Jl. Merdeka No. 1'],
            ['nama' => 'Siti Aminah', 'nim' => '10121002', 'jabatan' => 'Wakil Ketua', 'no_hp' => '081234567891', 'alamat' => 'Jl. Sudirman No. 2'],
        ];

        foreach ($anggotas as $anggota) {
            Anggota::create($anggota);
        }

        // 5. Seed Transaksi Dummy (Untuk ditampilkan di halaman landing page)
        \App\Models\Transaksi::create([
            'tanggal' => now()->subDays(10),
            'kategori_id' => 1, // Iuran
            'tipe' => 'pemasukan',
            'jumlah' => 5000000,
            'keterangan' => 'Iuran anggota bulan ini',
        ]);

        \App\Models\Transaksi::create([
            'tanggal' => now()->subDays(5),
            'kategori_id' => 2, // Sponsor
            'tipe' => 'pemasukan',
            'jumlah' => 2000000,
            'keterangan' => 'Sponsor dari PT Sejahtera',
        ]);

        \App\Models\Transaksi::create([
            'tanggal' => now()->subDays(2),
            'kategori_id' => 4, // Dana Kegiatan
            'tipe' => 'pengeluaran',
            'jumlah' => 1500000,
            'keterangan' => 'Pembelian perlengkapan acara',
        ]);
    }
}
