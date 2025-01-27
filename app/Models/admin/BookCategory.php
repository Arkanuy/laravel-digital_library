<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $table = 'kategori_buku';
    protected $guarded = [];

    public function buku()
    {
        return $this->belongsToMany(Book::class, 'kategori_buku_relasi', 'kategori_id', 'buku_id');
    }

    public function categoryRelation()
    {
        return $this->hasMany(RelationCategory::class, 'kategori_id');
    }

}
