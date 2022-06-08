<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class BarangKeluarController extends Controller
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
            $keluar = BarangKeluar::where('kode', 'like', "%" . $search . "%")
            ->orwhere('jumlah', 'like', "%" . $search . "%")
            ->orwhere('penanggung_jawab', 'like', "%" . $search . "%")
            ->orwhere('tgl_keluar', 'like', "%" . $search . "%")
            ->orWhereHas('barang', function($query) use($search) {
                return $query->where('nama_barang', 'like', "%" . $search . "%");
            })
            ->paginate();
            return view('BarangKeluar.index', compact('keluar'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $keluar = BarangKeluar::with('barang')->paginate(10); // Pagination menampilkan 5 data
            return view('BarangKeluar.index', compact('keluar'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $num = BarangKeluar::orderBy('kode','desc')->count();
        $dataCode = BarangKeluar::orderBy('kode','desc')->first();
        if ($num == 0) {
            $code = 'OUT001';
        }
        else{
            $c = $dataCode->kode;
            $code = substr($c, 3)+1;
            $code = "OUT00".$code;
        }
        $barang = Barang::where('jumlah_barang', '>', 0)->get();
        return view('BarangKeluar.create', compact('code', 'barang'));
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
    public function show($kode)
    {
        //menampilkan detail data dengan menemukan berdasarkan kode BarangKeluar
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
       
    }

    public function laporan()
    {
        
    }
}
