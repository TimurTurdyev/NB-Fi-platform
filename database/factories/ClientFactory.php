<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'firstname' => $this->faker->firstName($gender),
            'lastname' => $this->faker->lastName(),
            'patronymic' => $this->faker->firstNameMale()
        ];
    }
}
