<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama'=> 'admin',
            'username'=> 'admin',
            'role'=> 'admin',
            'password'=> 'password',
        ]);

        User::create([
            'nama'=> 'siswa',
            'username'=> 'siswa',
            'nis'=> '544241094',
            'kelas'=> 'XII RPL 4',
            'role'=> 'siswa',
            'password'=> 'password',
        ]);

        $fiksi = Kategori::create([
            'nama'=> 'Fiksi'
        ]);

        $teknologi = Kategori::create([
            'nama'=> 'Teknologi'
        ]);

        $pelajaran = Kategori::create([
            'nama'=> 'Pelajaran'
        ]);

        Buku::create([
            'kategori_id'=> $fiksi->id,
            'kode'=> 'BK001',
            'judul'=> 'Project Hail Mary',
            'pengarang'=> 'Saya',
            'penerbit'=> 'erlangga',
            'tahun'=> 2010,
            'stok'=> 10,
        ]);

        Buku::create([
            'kategori_id'=> $teknologi->id,
            'kode'=> 'BK002',
            'judul'=> 'Laravel',
            'pengarang'=> 'Saya',
            'penerbit'=> 'erlangga',
            'tahun'=> 2010,
            'stok'=> 10,
        ]);

        Buku::create([
            'kategori_id'=> $pelajaran->id,
            'kode'=> 'BK003',
            'judul'=> 'Buku TKA',
            'pengarang'=> 'Saya',
            'penerbit'=> 'erlangga',
            'tahun'=> 2010,
            'stok'=> 10,
        ]);
    }
}
