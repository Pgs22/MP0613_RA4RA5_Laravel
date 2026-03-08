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
        $prefixes = ['El secreto de', 'El regreso de', 'Más allá de', 'El último', 'La sombra de', 'Crónicas de', 'Misión en'];
        $nouns = ['la Galaxia', 'un Imperio', 'la Leyenda', 'el Silencio', 'un Guerrero', 'la Tormenta', 'la Jungla', 'un Destino'];
        
        $movieName = $this->faker->randomElement($prefixes) . ' ' . $this->faker->randomElement($nouns);
        $genres = ['action', 'drama', 'romance', 'suspense'];
        $selectedGenre = $this->faker->randomElement($genres);

        return [
            'name' => $movieName,
            'year' => $this->faker->numberBetween(1980, 2026),
            'genre' => $selectedGenre,
            'duration' => $this->faker->numberBetween(90, 180),
            'country' => $this->faker->country(),
            'img_url' => "https://loremflickr.com/600/400/movie,poster," . $selectedGenre . "/all?lock=" . md5($movieName),
        ];
    }
}
