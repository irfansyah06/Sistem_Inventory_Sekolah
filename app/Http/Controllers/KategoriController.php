<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class KategoriController extends Controller
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
        if(Gate::allows('manage-MasterData')) return $next($request);
        abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $kategori = Kategori::where('kode_kategori', 'like', "%" . $request->search . "%")
            ->orwhere('nama_kategori', 'like', "%" . $request->search . "%")
            ->orwhere('keterangan', 'like', "%" . $request->search . "%")
            ->paginate();
            return view('Kategori.index', compact('kategori'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $kategori = Kategori::paginate(10); // MenPagination menampilkan 5 data
            return view('Kategori.index', compact('kategori'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'kode_kategori' => 'required',
            'nama_kategori' => 'required',
            ]);

            //fungsi eloquent untuk menambah data
            Kategori::create($request->all());

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            Alert::success('Success', 'Data Kategori Barang Berhasil Ditambahkan');
            return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan detail data dengan menemukan berdasarkan id kategori
        $kategori = Kategori::find($id);
        return view('Kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan detail data dengan menemukan berdasarkan id kategori untuk diedit
        $kategori = Kategori::find($id);
        return view('Kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //melakukan validasi data
        $request->validate([
            'kode_kategori' => 'required',
            'nama_kategori' => 'required',
            'keterangan' => 'required',
            ]);

        //fungsi eloquent untuk mengupdate data inputan kita
            Kategori::find($id)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
            Alert::success('Success', 'Data Kategori Barang Berhasil Diupdate');
            return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
        Kategori::find($id)->delete();
        Alert::success('Success', 'Data kategori berhasil dihapus');
        return redirect()->route('kategori.index');
    }

    public function laporan()
    {
        $kategori = Kategori::all();
        $pdf = PDF::loadview('Kategori.laporan', compact('kategori'));
        return $pdf->stream();
    }
}
