<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'buku';

    protected $guarded = [];

    public function category() {
        return $this->belongsToMany(BookCategory::class, 'kategori_buku_relasi', 'buku_id', 'kategori_id');
    }

}
