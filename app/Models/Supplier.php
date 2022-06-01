<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Supplier extends Model
{
    use HasFactory;
    protected $table="supplier"; // Eloquent akan membuat model Supplier menyimpan record di tabel supplier
    protected $primaryKey = 'kode'; // Memanggil isi DB Dengan primarykey
    public $incrementing =false;

    protected $fillable = [
        'kode',
        'nama',
        'alamat',
        'telp',
        'kota',
        'penyedia',
    ];
    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
