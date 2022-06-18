<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->search;
        if($request->has('search')){
            $barang = Barang::where('kode_barang', 'like', "%" . $search . "%")
            ->orwhere('nama_barang', 'like', "%" . $search . "%")
            ->orwhere('jumlah_barang', 'like', "%" . $search . "%")
            ->orWhereHas('kategori', function($query) use($search) {
                return $query->where('nama_kategori', 'like', "%" . $search . "%");
            });
        } else {
            $barang = Barang::with('kategori')->paginate(10);
        }
        return view('Barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == 'Operator') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/barang');
        }

        $kategori = Kategori::all();
        $supplier = Supplier::all();
        return view('Barang.create', ['kategori' => $kategori], ['supplier' => $supplier]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role == 'Operator') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/barang');
        }

        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'gambar' => 'required',
            'jumlah_barang' => 'required',
            'id_kategori' => 'required',
            'id_supplier' => 'required',
            ]);

            if ($request->file('gambar')) {
                $image_name = $request->file('gambar')->store('images', 'public');
            }

            $kategori = Kategori::find($request->get('id_kategori'));
            $supplier = Supplier::find($request->get('id_supplier'));

            $barang = new Barang;
            $barang->kode_barang = $request->get('kode_barang');
            $barang->nama_barang = $request->get('nama_barang');
            $barang->gambar = $image_name;
            $barang->jumlah_barang = $request->get('jumlah_barang');

            $barang->kategori()->associate($kategori);
            $barang->supplier()->associate($supplier);
            $barang->save();

            Alert::success('Success', 'Data Barang Berhasil Ditambahkan');
            return redirect()->route('barang.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->role == 'Operator') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/barang');
        }

        $barang = Barang::with('kategori','supplier')->find($id);
        return view('Barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == 'Operator') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/barang');
        }

        $barang = Barang::with('kategori','supplier')->find($id);
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        return view('Barang.edit', compact('barang', 'kategori', 'supplier'));
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
        if(Auth::user()->role == 'Operator') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/barang');
        }

        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jumlah_barang' => 'required',
            'id_kategori' => 'required',
            'id_supplier' => 'required',
        ]);

        $barang = Barang::with('kategori', 'supplier')->where('id', $id)->first();

        if ($request->file('gambar') == ''){
            $barang->kode_barang = $request->get('kode_barang');
            $barang->nama_barang = $request->get('nama_barang');
            $barang->jumlah_barang = $request->get('jumlah_barang');

            $kategori = Kategori::find($request->get('id_kategori'));
            $supplier = Supplier::find($request->get('id_supplier'));

            $barang->kategori()->associate($kategori);
            $barang->supplier()->associate($supplier);
            $barang->save();
        } else{
            if ($barang->gambar && file_exists(storage_path('app/public/' .$barang->gambar)))
            {
                Storage::delete(['public/' . $barang->gambar]);
            }
            $image_name = $request->file('gambar')->store('images', 'public');
            $barang->gambar = $image_name;

            $barang->kode_barang = $request->get('kode_barang');
            $barang->nama_barang = $request->get('nama_barang');
            $barang->jumlah_barang = $request->get('jumlah_barang');

            $kategori = Kategori::find($request->get('id_kategori'));
            $supplier = Supplier::find($request->get('id_supplier'));

            $barang->kategori()->associate($kategori);
            $barang->supplier()->associate($supplier);
            $barang->save();
        }

        Alert::success('Success', 'Data Barang Berhasil Diedit');
        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->role == 'Operator') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/barang');
        }

        Barang::find($id)->delete();
        Alert::success('Success', 'Data Barang berhasil dihapus');
        return redirect()->route('barang.index');
    }

    public function laporan()
    {
        $barang = Barang::all();
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        $pdf = PDF::loadview('Barang.laporan', compact('barang', 'kategori', 'supplier'));
        return $pdf->stream();
    }
}
