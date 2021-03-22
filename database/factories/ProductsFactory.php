<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'vendor' => $this->faker->name,
            'type' => 'steel',
            'size' => $this->faker->numberBetween(1, 5) . ' X ' . $this->faker->numberBetween(1, 5),
            'price' => $this->faker->numberBetween(1.00, 10.00),
            'handle' => $this->faker->name,
            'inventory_quantity' => $this->faker->randomNumber(),
            'sku' => $this->faker->randomElement(['a', 'b', 'c']),
            'design_url' => $this->faker->url,
            'published_state' => 'active'
        ];
    }
}
