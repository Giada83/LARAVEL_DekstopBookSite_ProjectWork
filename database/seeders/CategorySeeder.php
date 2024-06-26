<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Fantasy',
            'Science Fiction',
            'Romance',
            'Mystery',
            'Thriller',
            'Horror',
            'Non-fiction',
            'Biography',
            'History',
            'Self-help',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
