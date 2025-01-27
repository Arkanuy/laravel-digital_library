<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class RelationCategory extends Model
{
    protected $table = 'kategori_buku_relasi';
    protected $guarded = [];

    public function buku()
    {
        return $this->belongsTo(Book::class, 'buku_id');
    }

    public function category(){
        return $this->belongsTo(BookCategory::class, 'kategori_id');
    }
}
