<?php

namespace Database\Factories;

use App\Models\Reservasi;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_reservasi' => Reservasi::factory(),
            'rating' => fake()->numberBetween(1, 5),
            'komentar' => fake()->sentence(),
        ];
    }
}
