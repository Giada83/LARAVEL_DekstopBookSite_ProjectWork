<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    //Relazione uno a molti con Author
    public function author(): BelongsTo //appartiene a
    {
        return $this->belongsTo(Author::class);
    }

    //Relazione molti a molti con Category - book_category
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    //Relazione molti a molti con User - book_user (aggiunta d libri ai preferiti)
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('status', 'is_favorite');
    }

    //Relazione uno a molti con Review 
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
