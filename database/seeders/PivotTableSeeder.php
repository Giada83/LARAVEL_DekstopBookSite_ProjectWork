<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generazione dati per book_category
        $books = Book::factory()->count(2)->create();
        $categories = Category::all()->random(2);

        foreach ($books as $book) {
            $book->categories()->attach($categories);
        }

        // Generazione dati per book_user
        $users = User::factory()->count(2)->create();
        $books = Book::all()->random(2);

        foreach ($users as $user) {
            foreach ($books as $book) {
                $user->books()->attach($book, [
                    'status' => ['already_read', 'reading', 'want_to_read'][rand(0, 2)],
                    'is_favorite' => (bool)rand(0, 1),
                ]);
            }
        }
    }
}
