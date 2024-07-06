<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{

    public function definition()
    {
        $authorId = \App\Models\Author::inRandomOrder()->first()->id;

        return [
            'author_id' => $authorId,
            'title' => $this->faker->realText(mt_rand(20, 40)),
            'cover' =>  $this->faker->imageUrl(640, 480, mt_rand(0, 1084), true),
            // 'description' => $this->faker->paragraph(5),
            'description' => $this->faker->realText(mt_rand(200, 1000)),
            'year' => $this->faker->numberBetween(1901, 2024),
            'language' => $this->faker->randomElement(['English', 'French', 'Spanish', 'German', 'Italian']),
        ];
    }
}
