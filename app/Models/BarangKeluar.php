<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\BarangMasuk;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table="barang_keluar"; // Eloquent akan membuat model BarangKeluar menyimpan record di tabel barang_keluar
    protected $primaryKey = 'kode'; // Memanggil isi DB Dengan primarykey
    public $incrementing =false;

    protected $fillable = [
        'kode',
        'id_barang',
        'jumlah',
        'penanggung_jawab',
        'tgl_keluar',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function BarangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
