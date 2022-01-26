<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->address(),
            'street' => $this->faker->streetName(),
            'house' => $this->faker->randomElement(['', rand(1, 199)]),
            'block' => $this->faker->randomElement(['', rand(1, 5)]),
            'flat' => $this->faker->randomElement(['', rand(1, 1000)]),
            'postcode' => $this->faker->randomElement(['', $this->faker->postcode()]),
        ];
    }
}
