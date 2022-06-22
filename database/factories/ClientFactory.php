<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fullName = $this->faker->name();
        $pieces = explode(' ', $fullName);
        return [
            'name' => $pieces[0],
            'last_name' => $pieces[1],
            'email' => $pieces[0].'.'.$pieces[1].'@example.com',
            'email_verified_at' => now(),
        ];
    }
}
