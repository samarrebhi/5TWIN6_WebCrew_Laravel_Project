<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\guideBP>
 */
class guideBPFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->text(1000),
            'category' => $this->faker->randomElement(['Recycling', 'Waste Management', 'Environmental Awareness']),

            'external_links' => $this->faker->url(),
            'tags' => implode(',', $this->faker->words(5)),  // Random tags (5 words separated by commas)
        ];
    }
}

