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
            'title' => $this->faker->sentence,
            'cover' =>  $this->faker->imageUrl(640, 480, mt_rand(0, 1084), true),
            'description' => $this->faker->paragraph($nbSentences = 5),
            'year' => $this->faker->numberBetween(1900, 2023),
            'language' => $this->faker->randomElement(['English', 'French', 'Spanish', 'German', 'Italian']),
        ];
    }
}
