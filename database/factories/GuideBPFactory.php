<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GuideBP>
 */
class GuideBPFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6),            // Random title with 6 words
            'description' => $this->faker->text(100),         // Random text for description
            'content' => $this->faker->paragraph(3),          // Random content as a paragraph
            'category' => $this->faker->word(),                // Random category word
            'author' => $this->faker->name(),                  // Random author name
            'status' => $this->faker->randomElement(['published', 'draft', 'archived']), // Random status
        ];
    }
}
