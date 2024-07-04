<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->pluck('id')->first(),
            'book_id' => Book::inRandomOrder()->pluck('id')->first(),
            'review' => $this->faker->paragraphs(rand(1, 3), true),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
