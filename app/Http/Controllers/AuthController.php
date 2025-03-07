<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Log; // Import model Log
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Login pengguna setelah pendaftaran
        Auth::login($user);
    
        // Simpan informasi pengguna ke dalam sesi
        session(['user_name' => $user->name]);

        // Menyimpan log aktivitas
        Log::create([
            'user_id' => $user->id,
            'action' => 'register',
            'table_name' => 'users',
            'old_value' => null,
            'new_value' => json_encode($user),
            'ip_address' => request()->ip(),
        ]);
    
        // Arahkan ke halaman home
        return redirect()->route('home')->with('success', 'Pendaftaran berhasil!');
    }
    
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.'
        ]);
    
        // Coba login
        if (Auth::attempt($request->only('email', 'password'))) {
            // Simpan informasi pengguna ke dalam sesi
            session(['user_name' => Auth::user()->name]);

            // Menyimpan log aktivitas
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'login',
                'table_name' => 'users',
                'old_value' => null,
                'new_value' => json_encode(Auth::user()),
                'ip_address' => request()->ip(),
            ]);
    
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }
    
        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email belum terdaftar.',
            'password' => 'Kombinasi email dan password salah.'
        ])->withInput();
    }

    public function logout()
    {
        // Menyimpan log aktivitas
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'logout',
            'table_name' => 'users',
            'old_value' => json_encode(Auth::user()),
            'new_value' => null,
            'ip_address' => request()->ip(),
        ]);
    
        // Logout pengguna
        Auth::logout();
        
        // Hapus informasi pengguna dari sesi
        session()->forget('user_name');
    
        // Arahkan ke halaman dashboard setelah logout
        return redirect()->route('login')->with('success', 'Anda telah keluar.');
    }
}