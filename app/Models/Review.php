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

    //Relazione uno a molti con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relazione uno a molti con Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
