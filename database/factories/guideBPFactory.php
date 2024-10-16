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
            'title' => $this->faker->sentence,           // Random title
            'content' => $this->faker->paragraphs(3, true), // Random content
            'category' => $this->faker->randomElement(['Recycling', 'Waste Management', 'Environmental Awareness']), // Random category

            'external_links' => $this->faker->url(),     // Random external link
            'tags' => implode(',', $this->faker->words(5)),  // Random tags (5 words separated by commas)
        ];
    }
}

