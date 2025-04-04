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
    public function login_view()
    {
        if (Auth::check()) {
            return redirect()->route('order.index');
        }

        return view("auth");
    }

    // Dashboard pengguna setelah login
    public function dashboard()
    {
        return view("dashboard");
    }

    // Menampilkan halaman profil pengguna
    public function profil()
    {
        $user = Auth::user();
        return view("profil", compact("user"));
    }

    // Menampilkan daftar order pengguna
    public function order()
    {
        return view("order");
    }

    // Menampilkan halaman ganti password
    public function gantipassword(Request $request)
    {

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);

    }

    // Logout pengguna
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout.');
    }

    // Proses login pengguna
    public function login_aksi(Request $request)
    {
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
    public function daftar_aksi(Request $request)
    {
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update($request->only(['name', 'email', 'no_hp', 'alamat']));

        return redirect()->route('pelanggan.profil', $user->id)->with('success', 'Profil berhasil diperbarui.');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::guard('web')->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }
    public function gantipass($id)
    {
        return view('gantipass');
    }
}
