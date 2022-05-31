<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Kategori extends Model
{
    use HasFactory;
    protected $table="kategori"; // Eloquent akan membuat model Kategori menyimpan record di tabel kategori
    protected $primaryKey = 'id'; // Memanggil isi DB Dengan primarykey
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [
        'id',
        'kode_kategori',
        'nama_kategori',
        'keterangan',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
