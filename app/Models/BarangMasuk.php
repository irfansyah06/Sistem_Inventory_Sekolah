<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\BarangKeluar;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table="barang_masuk"; // Eloquent akan membuat model BarangMasuk menyimpan record di tabel barang_masuk
    protected $primaryKey = 'kode_masuk'; // Memanggil isi DB Dengan primarykey
    public $incrementing =false;

    protected $fillable = [
        'kode_masuk',
        'id_keluar',
        'id_barang',
        'jumlah_masuk',
        'tgl_masuk',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function BarangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class, 'id_keluar');
    }

}
