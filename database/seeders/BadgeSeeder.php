<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge; // Assicurati di importare correttamente la classe Badge

class BadgeSeeder extends Seeder
{
    public function run()
    {
        Badge::updateOrCreate(
            ['name' => 'First Book Favorited'],
            [
                'description' => 'You have added your first book to favorites!',
                'icon' => 'https://upload.wikimedia.org/wikipedia/commons/0/02/Suit_Hearts_%28open_clipart%29.svg'
            ]
        );
    }
}
