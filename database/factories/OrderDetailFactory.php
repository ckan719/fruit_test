<?php

namespace Database\Factories;

use App\Models\FruitCategoryNote;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::all()->random()->id,
            'fruit_category_note_id' => FruitCategoryNote::all()->random()->id,
            'quantity' => $this->faker->numberBetween(1, 20),
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
