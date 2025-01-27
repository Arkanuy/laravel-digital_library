<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Book;
use App\Models\peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        $user_count = User::where('role', 'user')->count();
        $admin_count = User::where('role', 'admin')->count();
        $total_buku = Book::all()->count();
        $total_peminjaman = peminjaman::all()->count();
        $sudah_dikembalikan = peminjaman::where('status_peminjaman', 'Sudah di kembalikan')->count();
        $belum_dikembalikan = peminjaman::where('status_peminjaman', 'Belum dikembalikan')->count();

        return view('admin.dashboard', compact('user_count', 'admin_count', 'total_buku', 'total_peminjaman', 'sudah_dikembalikan', 'belum_dikembalikan'));
    }
}
