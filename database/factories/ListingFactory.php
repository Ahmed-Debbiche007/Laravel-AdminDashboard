<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph(6, true),
            'tags' => "tags, to, product",
            'photo' => "Null",
        ];

    }
}
