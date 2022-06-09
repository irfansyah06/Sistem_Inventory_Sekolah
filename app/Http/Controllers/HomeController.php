<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\User;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kategori       = Kategori::get();
        $barang         = Barang::get();
        $supplier       = Supplier::get();
        $user           = User::get();
        $BarangKeluar   = BarangKeluar::get();
        $BarangMasuk    = BarangMasuk::get();

        return view('dashboard', compact('kategori', 'barang', 'supplier', 'user', 'BarangKeluar', 'BarangMasuk'));
    }
}
