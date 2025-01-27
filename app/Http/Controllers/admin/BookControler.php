<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Book;
use App\Models\admin\BookCategory;
use Illuminate\Http\Request;

class BookControler extends Controller
{
    public function index(){
        $category = BookCategory::all();
        $book = Book::all();
        return view('admin.book.index', compact('category', 'book'));
    }

    public function submit_kategori(Request $request){
        $data = $request->validate([
            'nama_kategori' => ['required']
        ]);

        $kategori = BookCategory::create([
            'nama_kategori' => $data['nama_kategori']
        ]);

        return redirect()->route('admin.book.index');
    }

    public function destroy_category($id){
        $category = BookCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.book.index');
    }

    public function update_category(Request $request, $id){
        $data = $request->validate([
            'nama_kategori' => ['required']
        ]);

        $category = BookCategory::findOrFail($id);
        $category->update([
            'nama_kategori' => $data['nama_kategori']
        ]);

        return redirect()->route('admin.book.index');
    }

    public function store_book(Request $request){
        $data = $request->validate([
            'judul' => ['required'],
            'penulis' => ['required'],
            'penerbit' => ['required'],
            'tahun' => ['required'],
            'kategori_id' => ['required']
        ]);

        $buku = Book::create([
            'judul' => $data['judul'],
            'penulis' => $data['penulis'],
            'penerbit' => $data['penerbit'],
            'tahun' => $data['tahun']
        ]);

        $buku->category()->attach($data['kategori_id']);

        return redirect()->route('admin.book.index');
    }

    public function destroy_book($id){
        $buku = Book::findOrFail($id);
        $buku->delete();

        return redirect()->route('admin.book.index');
    }

    public function update_book(Request $request, $id){
        $data = $request->validate([
            'judul' => ['required'],
            'penulis' => ['required'],
            'penerbit' => ['required'],
            'tahun' => ['required'],
            'kategori_id' => ['required']
        ]);

        $buku = Book::findOrFail($id);
        $buku->update([
            'judul' => $data['judul'],
            'penulis' => $data['penulis'],
            'penerbit' => $data['penerbit'],
            'tahun' => $data['tahun']
        ]);

        $buku->category()->sync($data['kategori_id']);

        return redirect()->route('admin.book.index');
    }
}
