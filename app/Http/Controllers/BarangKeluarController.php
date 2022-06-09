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
        $this->validate($request, [
            'kode' => 'required',
            'id_barang' => 'required',
            'jumlah' => 'required',
            'penanggung_jawab' => 'required',
            'tgl_keluar' => 'required',

        ]);
        $keluar = new BarangKeluar;
        $keluar->kode = $request->get('kode');
        $keluar->id_barang = $request->get('id_barang');
        $keluar->jumlah = $request->get('jumlah');
        $keluar->penanggung_jawab = $request->get('penanggung_jawab');
        $keluar->tgl_keluar = $request->get('tgl_keluar');

        $jumlah = $request->get('jumlah');
        if ($jumlah > $keluar->barang->jumlah_barang) {
            alert()->error('Error.','Jumlah yang anda masukkan melebihi stok barang!');
            return redirect()->route('BarangKeluar.create');
        } else {
            $keluar->save();
            $keluar->barang->where('id', $keluar->id_barang)
                            ->update([
                                'jumlah_barang' => ($keluar->barang->jumlah_barang - ($keluar->jumlah)),
                                ]);

            alert()->success('Berhasil.','Data telah ditambahkan!');
            return redirect()->route('BarangKeluar.index');
        }
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
        $keluar = BarangKeluar::with('barang')->find($kode);
        $barang = Barang::all();
        return view('BarangKeluar.show', compact('keluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode)
    {
        $keluar = BarangKeluar::with('barang')->find($kode);
        $barang = Barang::all();
        return view('BarangKeluar.edit', compact('keluar', 'barang'));
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
        $request->validate([
            'id_barang' => 'required',
            'jumlah' => 'required',
            'penanggung_jawab' => 'required',
            'tgl_keluar' => 'required',

        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        $keluar = BarangKeluar::with('barang')->where('kode', $kode)->first();
        // $keluar = BarangKeluar::find($kode)->update($request->all());

        $keluar->penanggung_jawab = $request->get('penanggung_jawab');
        $keluar->tgl_keluar = $request->get('tgl_keluar');
        $barang = Barang::find($request->get('id_barang'));
        //fungsi eloquent untuk menambah data dengan relasi belongsTo
        $keluar->barang()->associate($barang);
        $jumlah = $request->get('jumlah');

        if (($jumlah-$keluar->jumlah) > $keluar->barang->jumlah_barang) {
            alert()->error('Error.','Jumlah yang anda masukkan melebihi stok barang!');
            return redirect()->route('BarangKeluar.edit',$keluar->kode);
        }else {
            $keluar->barang->where('id', $keluar->id_barang)
                    ->update([
                        'jumlah_barang' => ($keluar->barang->jumlah_barang - ($jumlah - $keluar->jumlah)),
                    ]);
        }
        $keluar->jumlah = $request->get('jumlah');
        $keluar->save();

        alert()->success('Berhasil.','Data telah diupdate!');
        return redirect()->route('BarangKeluar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        BarangKeluar::find($kode)->delete();
        Alert::success('Success', 'Data Barang Keluar berhasil dihapus');
        return redirect()->route('BarangKeluar.index');
    }

    public function laporan()
    {
        $keluar = BarangKeluar::all();
        $barang = Barang::all();
        $pdf = PDF::loadview('BarangKeluar.laporan', compact('keluar', 'barang'));
        return $pdf->stream();
    }
}
