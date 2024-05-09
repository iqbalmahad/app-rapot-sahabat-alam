<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editPassword()
    {
        return view('profile.password_edit');
    }

    public function updatePassword(Request $request)
    {
        // Validasi input password baru
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Periksa apakah password saat ini sesuai dengan yang dimasukkan oleh user
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini salah.'])->withInput();
        }

        $request->user()->update([
            'password' => $request->password,
            'is_first_visit' => 0
        ]);

        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard')->with('success', 'Password berhasil diubah.');
        } else {
            return redirect()->route('dashboard')->with('success', 'Password berhasil diubah.');
        }
    }
}
