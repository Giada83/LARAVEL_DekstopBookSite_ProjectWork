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
}
