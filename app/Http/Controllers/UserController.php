<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
class UserController extends Controller
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
            $user = User::where('name', 'like', "%" . $request->search . "%")
            ->orwhere('email', 'like', "%" . $request->search . "%")
            ->orwhere('role', 'like', "%" . $request->search . "%")
            ->paginate();
            return view('User.index', compact('user'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $user = User::paginate(10); // MenPagination menampilkan 5 data
            return view('User.index', compact('user'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.create');
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'gambar' => 'required',
            'role' => 'required',
            ]);

            if ($request->file('gambar')) {
                $image_name = $request->file('gambar')->store('images', 'public');
            }

            //fungsi eloquent untuk menambah data
            $user = new User;
            $user->name = $request->get('name');
            $user->username = $request->get('username');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->gambar = $image_name;
            $user->role = $request->get('role');

            $user -> save();
            //User::create($request->all());
            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            Alert::success('Success', 'Data User Barang Berhasil Ditambahkan');
            return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan detail data dengan menemukan berdasarkan id User
        $user = User::find($id);
        return view('User.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan detail data dengan menemukan berdasarkan id User untuk diedit
        $user = User::find($id);
        return view('User.edit', compact('user'));
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
            ]);

        $user = User::find($id);

        //fungsi eloquent untuk mengupdate data inputan kita
        if ($request->file('gambar') == ''){
            $user->name = $request->get('name');
            $user->username = $request->get('username');
            $user->email = $request->get('email');
            $user->role = $request->get('role');
            $user->save();
        }
        else {
            if ($user->gambar && file_exists(storage_path('app/public/' .$user->gambar)))
        {
            \Storage::delete(['public/' . $user->gambar]);
        }
        $image_name = $request->file('gambar')->store('images', 'public');
        $user->gambar = $image_name;
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->role = $request->get('role');
        $user->save();
        }

        //jika data berhasil diupdate, akan kembali ke halaman utama
        Alert::success('Success', 'Data User Berhasil Diupdate');
        return redirect()->route('user.index');
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
        User::find($id)->delete();
        Alert::success('Success', 'Data user berhasil dihapus');
        return redirect()->route('user.index');
    }

    public function laporan()
    {
        $user = User::all();
        $pdf = PDF::loadview('User.laporan', compact('user'));
        return $pdf->stream();
    }

    public function EditPassword($id)
    {
        $user = User::find($id);
        return view('User.PasswordEdit', compact('user'));
    }

    public function UpdatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:5|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        Alert::success('Success', 'Password successfully changed!');
            return redirect()->route('user.edit', $user->id);
    }
}
