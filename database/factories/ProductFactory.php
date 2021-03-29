<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(2, true);
        return [
            "sub_cat_id" => $this->faker->numberBetween(1, 4),
            "name" => $name,
            "slug" => str_replace(" ", "-", $name),
            "price" => $this->faker->numberBetween(1000, 3000),
            "description" => $this->faker->paragraph(5, false),
        ];
    }
}
