<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sondage>
 */
class SondageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'titre' => $this->faker->sentence(3), // Generates a title with 3 words
            'description' => $this->faker->text(100), // Description up to 100 characters
            'questions' => $this->generateRandomQuestions(), // Random questions generated
            'start_date' => $this->faker->dateTimeBetween('now', '+1 week'), // Random start date within the next week
            'end_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'), // Random end date within a month after start
            'response_count' => 0, // Default value for response count
            'category' => $this->faker->word(), // Random category
            'location' => $this->faker->address(),


        ];


    }


    // Custom method to generate an array of random questions
    private function generateRandomQuestions()
    {
        $questions = [];
        $numberOfQuestions = $this->faker->numberBetween(3, 5);  // Generate between 3 to 5 questions

        for ($i = 0; $i < $numberOfQuestions; $i++) {
            $questions[] = $this->faker->sentence(6);  // Generates a random question with 6 words
        }

        return implode('|', $questions);  // Returns the questions as a concatenated string
    }
}
