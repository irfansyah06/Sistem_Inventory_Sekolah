<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('Profile.PasswordEdit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:5|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            Alert::error('Error', 'Current password does not match!');
            return back();
        }

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        Alert::success('Success', 'Password successfully changed!');
            return redirect()->route('profile.edit', $user->id);
    }
}
