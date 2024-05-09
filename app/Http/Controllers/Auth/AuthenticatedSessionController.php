<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();

        $request->session()->regenerate();



        if (Auth::user()->hasRole('admin')) {
            // Check if the user is logging in for the first time
            if (Auth::user()->is_first_visit == 1) {
                return redirect()->intended('/profile/password-edit')->with('info', 'Silakan perbarui password Anda untuk menjaga keamanan data.');
            }
            return redirect()->intended('admin/dashboard');
        }
        // Check if the user is logging in for the first time
        if (Auth::user()->is_first_visit == 1) {
            return redirect()->route('profile.password-edit')->with('info', 'Silakan perbarui password Anda untuk menjaga keamanan data.');
        }
        return redirect()->intended('dashboard');

        return back()->withErrors([
            'email_or_username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
