<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Center>
 */
class CenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(20),
            'description'=> $this->faker->text(100),
            'phone'=>$this->faker->randomNumber(8),
            'address'=> $this->faker->text(100),
            'email'=>$this->faker->email(20),
        ];
    }
}
