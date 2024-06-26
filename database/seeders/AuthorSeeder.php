<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;


class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea nuovi dati utilizzando il factory
        Author::factory()->count(30)->create();
    }
}
