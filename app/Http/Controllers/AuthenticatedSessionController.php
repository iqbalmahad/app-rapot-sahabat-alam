<?php

namespace App\Http\Controllers;

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
            return redirect()->intended('admin/dashboard');
        }
        return redirect()->intended('dashboard');

        return back()->withErrors([
            'email_or_username' => 'The provided credentials do not match our records.',
        ]);
    }
    // Metode lain...

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
