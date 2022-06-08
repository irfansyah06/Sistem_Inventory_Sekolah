<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
        if(Gate::allows('manage-transaksi')) return $next($request);
        abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $search = $request->search;
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $masuk = BarangMasuk::where('kode_masuk', 'like', "%" . $search . "%")
            ->orwhere('jumlah_masuk', 'like', "%" . $search . "%")
            ->orwhere('tgl_masuk', 'like', "%" . $search . "%")
            ->orWhereHas('barang', function($query) use($search) {
                return $query->where('nama_barang', 'like', "%" . $search . "%");
            })
            ->paginate();
            return view('BarangMasuk.index', compact('masuk'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $masuk = BarangMasuk::with('BarangKeluar')->paginate(10); // Pagination menampilkan 5 data
            return view('BarangMasuk.index', compact('masuk'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $num = BarangMasuk::orderBy('kode_masuk','desc')->count();
        $dataCode = BarangMasuk::orderBy('kode_masuk','desc')->first();
        if ($num == 0) {
            $code = 'IN001';
        }
        else{
            $c = $dataCode->kode_masuk;
            $code = substr($c, 3)+1;
            $code = "IN00".$code;
        }
        $keluar = BarangKeluar::where('jumlah', '>', 0)->get();
        return view('BarangMasuk.create', compact('code', 'keluar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode_masuk)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_masuk)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_masuk)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_masuk)
    {

    }

}
