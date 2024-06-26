<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    //Relazione uno a molti con Books
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
