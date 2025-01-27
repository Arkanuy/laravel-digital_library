<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $users = User::where('username', $request->username)->first();

        if (!$users) {
            return back()->withErrors([
                'username' => 'akun tidak di temukan!'
            ]);
        }

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if(Auth::user()->role == 'petugas') {
                return redirect()->route('petugas.dashboard');
            }else if(Auth::user()->role == 'user') {
                return redirect()->route('user.book.index');
            }
        }

        return back()->withErrors([
            'password' => 'password yang anda masukan salah'
        ]);
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register(Request $request){
        $data = $request->validate([
            'nama_lengkap' => ['required'],
            'email' => ['required', 'email'],
            'username' => ['required'],
            'password' => ['required', 'min:8'],
            'alamat' => ['required']
        ]);

        if (preg_match('/[!@#$%^&*()_+]/', $data['nama_lengkap'])) {
            return back()->withErrors([
                'nama_lengkap' => 'Nama tidak boleh mengandung simbol'
            ])->withInput();
        }

        $user = User::get()->where('username', $request->username)->first();

        if($user) {
            return back()->withErrors([
                'username' => 'username sudah ada'
            ]);
        }

        User::create([
            'nama_lengkap' => $data['nama_lengkap'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'role' => 'user',
            'alamat' => $data['alamat']
        ]);

        return redirect()->route('login');
    }
}
