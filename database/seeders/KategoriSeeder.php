<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Kategori::insert([
            [
                'kode_kategori' => 'KT001',
                'nama_kategori' => 'Elektronik',
                'keterangan' => 'Semua barang di ruang multimedia',
            ],
            [
                'kode_kategori' => 'KT002',
                'nama_kategori' => 'Kendaraan',
                'keterangan' => 'Isi BBM setelah pinjam',
            ],
            [
                'kode_kategori' => 'KT003',
                'nama_kategori' => 'Ruangan',
                'keterangan' => 'Semua ruangan di sekolah',
            ],
        ]);
    }
}
