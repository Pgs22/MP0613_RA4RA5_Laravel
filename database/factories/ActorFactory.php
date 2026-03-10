<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
$gender = $this->faker->randomElement(['male', 'female']);
        $name = $this->faker->firstName($gender);
        
        $styles = ['hollywood', 'portrait', 'dramatic', 'costume', 'action-hero'];
        $selectedStyle = $this->faker->randomElement($styles);

        return [
            'name' => $name, 
            'surname' => $this->faker->lastName(), 
            'birthdate' => $this->faker->date('Y-m-d', '-20 years'), 
            'country' => $this->faker->country(), 
            'img_url' => "https://loremflickr.com/400/600/actor,{$selectedStyle},person/all?lock=" . md5($name),
            'alias' => $this->faker->userName(),
        ];
    }
}
