<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
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
            'password' => bcrypt($pieces[0]), // password
            'remember_token' => Str::random(10),
            'role'=> 'Guest'
        ];
    }

    

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
