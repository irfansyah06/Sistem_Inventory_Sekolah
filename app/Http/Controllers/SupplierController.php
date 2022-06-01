<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class SupplierController extends Controller
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
            $supplier = Supplier::where('kode', 'like', "%" . $request->search . "%")
            ->orwhere('nama', 'like', "%" . $request->search . "%")
            ->orwhere('alamat', 'like', "%" . $request->search . "%")
            ->orwhere('telp', 'like', "%" . $request->search . "%")
            ->orwhere('kota', 'like', "%" . $request->search . "%")
            ->orwhere('penyedia', 'like', "%" . $request->search . "%")
            ->paginate();
            return view('Supplier.index', compact('supplier'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $supplier = Supplier::paginate(10); // MenPagination menampilkan 5 data
            return view('Supplier.index', compact('supplier'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $num = Supplier::orderBy('kode','desc')->count();
        $dataCode = Supplier::orderBy('kode','desc')->first();
        if ($num == 0) {
            $code = 'SUP001';
        }
        else{
            $c = $dataCode->kode;
            $code = substr($c, 3)+1;
            $code = "SUP00".$code;
        }
        return view('Supplier.create',compact('code'));
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
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'kota' => 'required',
            'penyedia' => 'required',
            ]);

            //fungsi eloquent untuk menambah data
            Supplier::create($request->all());

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            Alert::success('Success', 'Data Supplier Berhasil Ditambahkan');
            return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode)
    {
        //menampilkan detail data dengan menemukan berdasarkan kode supplier
        $supplier = Supplier::find($kode);
        return view('Supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode)
    {
        //menampilkan detail data dengan menemukan berdasarkan kode supplier untuk diedit
        $supplier = Supplier::find($kode);
        return view('Supplier.edit', compact('supplier'));
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
        //melakukan validasi data
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'kota' => 'required',
            'penyedia' => 'required',
            ]);

        //fungsi eloquent untuk mengupdate data inputan kita
            Supplier::find($kode)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
            Alert::success('Success', 'Data Supplier Berhasil Diupdate');
            return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        //fungsi eloquent untuk menghapus data
        Supplier::find($kode)->delete();
        Alert::success('Success', 'Data Supplier Berhasil Dihapus');
        return redirect()->route('supplier.index');
    }

    public function laporan()
    {
        $supplier = Supplier::all();
        $pdf = PDF::loadview('Supplier.laporan', compact('supplier'));
        return $pdf->stream();
    }
}
