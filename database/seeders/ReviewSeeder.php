<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $books = Book::all();

        foreach ($books as $book) {
            $numReviews = rand(1, 3);
            // Utilizza la factory per creare recensioni per il libro corrente
            Review::factory()->count($numReviews)->create([
                'book_id' => $book->id,
            ]);
        }
    }
}
