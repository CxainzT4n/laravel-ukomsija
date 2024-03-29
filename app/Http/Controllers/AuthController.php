<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{

    public function index() {
        return view('login.sign-in');
    }

public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        // Pemeriksaan peran pengguna setelah berhasil login
        $user = Auth::user();

        if ($user->level === 'administrator') {
            return redirect()->intended('/Dashboard-Admin');
        } elseif ($user->level === 'management') {
            return redirect()->intended('/management/dashboard');
        } else {
            return redirect()->intended('/Dashboard');
        }
    }

    return redirect()->back()->withErrors(['username' => 'Invalid username or password']);
}

public function logout()
{
    Auth::logout();
    return redirect('/login');
}

public function logoutAdmin()
{
    return $this->logout(); // Panggil metode logout umum
}
public function logoutUser()
{
    return $this->logout(); // Panggil metode logout umum
}

}
