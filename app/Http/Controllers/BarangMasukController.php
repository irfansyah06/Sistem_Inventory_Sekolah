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
        if($request->has('search')){
            $masuk = BarangMasuk::where('kode_masuk', 'like', "%" . $search . "%")
            ->orwhere('jumlah_masuk', 'like', "%" . $search . "%")
            ->orwhere('tgl_masuk', 'like', "%" . $search . "%")
            ->orWhereHas('barang', function($query) use($search) {
                return $query->where('nama_barang', 'like', "%" . $search . "%");
            });
        } else {
            $masuk = BarangMasuk::with('BarangKeluar')->paginate(10);
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
        $this->validate($request, [
            'kode_masuk' => 'required',
            'id_keluar' => 'required',
            'id_barang' => 'required',
            'jumlah_masuk' => 'required',
            'tgl_masuk' => 'required',
        ]);


        $masuk = BarangMasuk::create($request->all());

        $masuk->barang->where('id', $masuk->id_barang)
                        ->update([
                            'jumlah_barang' => ($masuk->barang->jumlah_barang + ($masuk->jumlah_masuk)),
                        ]);

        $masuk->BarangKeluar->where('kode', $masuk->id_keluar)
                        ->update([
                            'jumlah' => ($masuk->BarangKeluar->jumlah - ($masuk->jumlah_masuk)),
                        ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');
        return redirect()->route('BarangMasuk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode_masuk)
    {

        $masuk = BarangMasuk::with('BarangKeluar')->find($kode_masuk);
        return view('BarangMasuk.show', compact('masuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_masuk)
    {
        $masuk = BarangMasuk::with('BarangKeluar')->find($kode_masuk);
        $keluar = BarangKeluar::all();
        return view('BarangMasuk.edit', compact('masuk', 'keluar'));
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

        $request->validate([
            'id_keluar' => 'required',
            'id_barang' => 'required',
            'jumlah_masuk' => 'required',
            'tgl_masuk' => 'required',

        ]);


        $masuk = BarangMasuk::with('BarangKeluar')->where('kode_masuk', $kode_masuk)->first();
        $masuk->tgl_masuk = $request->get('tgl_masuk');
        $keluar = BarangKeluar::find($request->get('id_keluar'));

        $masuk->BarangKeluar()->associate($keluar);
        $barang = Barang::find($request->get('id_barang'));

        $masuk->barang()->associate($barang);
        $jumlah_masuk = $request->get('jumlah_masuk');
        if($masuk->jumlah_masuk != $jumlah_masuk) {
            $masuk->BarangKeluar->where('kode', $masuk->id_keluar)
                    ->update([
                        'jumlah' => ($masuk->BarangKeluar->jumlah - ($jumlah_masuk - $masuk->jumlah_masuk)),
                    ]);
            $masuk->barang->where('id', $masuk->id_barang)
                    ->update([
                        'jumlah_barang' => ($masuk->barang->jumlah_barang + ($jumlah_masuk - $masuk->jumlah_masuk)),
                    ]);
        }
        $masuk->jumlah_masuk = $request->get('jumlah_masuk');
        $masuk->save();

        alert()->success('Berhasil.','Data telah diupdate!');
        return redirect()->route('BarangMasuk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_masuk)
    {
        BarangMasuk::find($kode_masuk)->delete();
        Alert::success('Success', 'Data Barang Masuk berhasil dihapus');
        return redirect()->route('BarangMasuk.index');
    }

    public function laporan()
    {
        $masuk = BarangMasuk::all();
        $pdf = PDF::loadview('BarangMasuk.laporan', compact('masuk'));
        return $pdf->stream();
    }
}
