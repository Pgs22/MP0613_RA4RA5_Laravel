<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomId = $this->faker->numberBetween(1, 1000);
        
        return [
            'name' => $this->faker->sentence(3),
            'year' => $this->faker->year(),
            'genre' => $this->faker->randomElement(['suspense', 'action', 'drama', 'romance']),
            'duration' => $this->faker->numberBetween(80, 180),
            'country' => $this->faker->country(),
            'img_url' => "https://picsum.photos/id/{$randomId}/600/400",
        ];
    }
}
