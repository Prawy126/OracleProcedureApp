<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('logowanie');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $accountType = $user->account_type;

            switch ($accountType) {
                case 1:
                    return redirect()->intended(route('admin'));
                case 3:
                    return redirect()->intended(route('doctor.dashboard'));
                case 2:
                    return redirect()->intended(route('nurse.dashboard'));
                case 4:
                    return redirect()->intended(route('patient.dashboard'));
                default:
                    Auth::logout();
                    return back()->withErrors([
                        'login' => 'Nieznany typ konta!',
                    ]);
            }
        }

        return back()->withErrors([
            'login' => 'Podane dane są nieprawidłowe!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
