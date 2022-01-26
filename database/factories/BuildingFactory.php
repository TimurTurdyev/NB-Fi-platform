<?php

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $last = Building::orderByDesc('id')->first();
        return [
            'name' => $this->faker->city() . ' ' . ($last?->id + 1)
        ];
    }
}
