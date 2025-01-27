<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Book;
use App\Models\peminjaman;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $book = Book::all();
        return view('user.book.index', compact('book'));
    }
}
