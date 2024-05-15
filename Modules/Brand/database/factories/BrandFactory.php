<?php

namespace Modules\Brand\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Brand\Models\Brand::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'priority' => $this->faker->numberBetween(1, 10),
            'image' => $this->faker->imageUrl(), // This generates a random image URL, you might want to adjust this based on your needs
        ];
    }
}

