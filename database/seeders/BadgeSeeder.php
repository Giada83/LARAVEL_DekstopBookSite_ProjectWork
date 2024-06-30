<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge; // Assicurati di importare correttamente la classe Badge

class BadgeSeeder extends Seeder
{
    public function run()
    {
        Badge::updateOrCreate(
            ['name' => 'Primo Libro ai Preferiti'],
            [
                'description' => 'Hai aggiunto il tuo primo libro ai preferiti!',
                'icon' => 'https://upload.wikimedia.org/wikipedia/commons/0/02/Suit_Hearts_%28open_clipart%29.svg'
            ]
        );
    }
}
