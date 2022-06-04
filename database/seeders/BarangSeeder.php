<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Barang::insert([
            [
                'kode_barang' => 'MB01',
                'nama_barang' => 'Mobil',
                'gambar' => '/img/mobil.png',
                'jumlah_barang' => 2,
                'id_kategori' => 2,
            ],
            [
                'kode_barang' => 'KM01',
                'nama_barang' => 'Komputer',
                'gambar' => '/img/komputer.jpg',
                'jumlah_barang' => 50,
                'id_kategori' => 1,
            ],
            [
                'kode_barang' => 'LK01',
                'nama_barang' => 'Mobil',
                'gambar' => '/img/labkimia.jpg',
                'jumlah_barang' => 2,
                'id_kategori' => 3,
            ],
        ]);
    }
}
