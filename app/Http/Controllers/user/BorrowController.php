<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Book;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $peminjaman = peminjaman::where('user_id', Auth::user()->id)
            ->orderBy('status_peminjaman', 'asc')
            ->get();

        return view('user.borrow.index', compact('books', 'peminjaman'));
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'buku_id' => ['required'],
        ]);


        $user = Auth::user()->id;

        $peminjaman = peminjaman::where('buku_id', $data['buku_id'])
            ->where('user_id', $user)
            ->where('status_peminjaman', 'Belum dikembalikan')->first();

        if ($peminjaman) {
            return back()->with('error', 'buku yang sama anda pinjam belum di kembalikan');
        }

        $data['user_id'] = $user;
        $data['tangal_peminjaman'] = now();
        $data['status_peminjaman'] = 'Belum dikembalikan';

        peminjaman::create($data);

        return redirect()->route('user.borrow.index');
    }

    public function update($id){
        $peminjaman = peminjaman::find($id);

        $peminjaman->update([
            'tanggal_pengembalian' => now(),
            'status_peminjaman' => 'Sudah di kembalikan'
        ]);

        return redirect()->route('user.borrow.index');
    }
}
