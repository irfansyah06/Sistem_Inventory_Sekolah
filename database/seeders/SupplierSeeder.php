<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Supplier::insert([
            [
                'kode' => 'SUP001',
                'nama' => 'PT. Sinar Jaya',
                'alamat' => 'Jl. Patiunus No.25',
                'telp' => '081234500000',
                'kota' => 'Pasuruan',
                'penyedia' => 'Barang Elektronik',
            ],
            [
                'kode' => 'SUP002',
                'nama' => 'Mebel Lumintu',
                'alamat' => 'Jl. Bukir No.04',
                'telp' => '082005567123',
                'kota' => 'Probolinggo',
                'penyedia' => 'Meja dan Kursi',
            ],
            [
                'kode' => 'SUP003',
                'nama' => 'PT. Sehat Ceria',
                'alamat' => 'Jl. Pahlawan No.10',
                'telp' => '085001185961',
                'kota' => 'Surabaya',
                'penyedia' => 'Sarana Olahraga',
            ],
        ]);
    }
}
