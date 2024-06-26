<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    //Relazione molti a molti con Book
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
