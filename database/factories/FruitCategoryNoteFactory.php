<?php

namespace Database\Factories;

use App\Models\FruitCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FruitCategoryNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $unit = ['kg', 'pcs', 'pack'];
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(1,1000),
            'unit' => $unit[array_rand($unit)],
            'fruit_category_id' => FruitCategory::all()->random()->id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
    }
}
