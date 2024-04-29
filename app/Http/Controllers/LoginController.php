<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    
    public function username()
    {
        $login = request()->input('email_or_username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if (Auth::user()->hasRole('admin')) {
                return redirect()->intended('admin/dashboard');
            }
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email_or_username' => 'The provided credentials do not match our records.',
        ]);
    }
    // Metode lain...

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
