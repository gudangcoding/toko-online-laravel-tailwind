<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PelangganController extends Controller
{
    // Menampilkan halaman login & pendaftaran
    public function login_view() {
        if (Auth::check()) {
            return redirect()->route('order.index');
        }

        return view("auth");
    }

    // Dashboard pengguna setelah login
    public function dashboard() {
        return view("dashboard");
    }

    // Menampilkan halaman profil pengguna
    public function profil() {
        return view("profil");
    }

    // Menampilkan daftar order pengguna
    public function order() {
        return view("order");
    }

    // Menampilkan halaman ganti password
    public function gantipassword(Request $request) {
    
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    
    }

    // Logout pengguna
    public function logout() {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout.');
    }

    // Proses login pengguna
    public function login_aksi(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('order.index')->with('success', 'Login berhasil!');
        } else {
            return back()->with('error', 'Email atau password salah.');
        }
    }

    // Proses pendaftaran pengguna
   public function daftar_aksi(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:500',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
