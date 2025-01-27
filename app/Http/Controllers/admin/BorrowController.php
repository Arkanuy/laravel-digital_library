<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\peminjaman;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index(){
        $peminjaman = peminjaman::orderBy('status_peminjaman', 'asc')->get();
        return view('admin.borrow.index', compact('peminjaman'));
    }
}
