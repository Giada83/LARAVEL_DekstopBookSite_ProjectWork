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
            ['name' => 'Fantasy', 'color' => '#C7DCDF'],
            ['name' => 'Science', 'color' => '#F2CBBD'],
            ['name' => 'Romance', 'color' => '#FFC6BF'],
            ['name' => 'Mystery', 'color' => '#C7CFDC'],
            ['name' => 'Thriller', 'color' => '#C5D9C7'],
            ['name' => 'Horror', 'color' => '#798C79'],
            ['name' => 'Non-fiction', 'color' => '#91A3BA'],
            ['name' => 'Biography', 'color' => '#F5CEA6'],
            ['name' => 'History', 'color' => '#FFD8BE'],
            ['name' => 'Self-help', 'color' => '#CEDEF2'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'color' => $category['color'],
            ]);
        }
    }
}
