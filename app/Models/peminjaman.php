<?php

namespace App\Models;

use App\Models\admin\Book;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $guarded = [];


    public function buku(){
        return $this->belongsTo(Book::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
