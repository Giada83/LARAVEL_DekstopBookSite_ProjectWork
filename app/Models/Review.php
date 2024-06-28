<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'review',
        'rating',
    ];

    // Relazione con l'utente che ha lasciato la recensione
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relazione con il libro recensito
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
