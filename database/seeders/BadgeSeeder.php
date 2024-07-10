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
                'icon' => 'assets/image/badge_1.png'
            ]
        );
    }
}
