<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Listing;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        \DB::table('users')->insert(
            [
                'name' => 'Admin',
                'last_name' => 'istrator',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
                'remember_token' => Str::random(10),
                'role'=> 'Admin'
            ]
            );

        User::factory(10)->create();
        Client::factory(10)->create();
        Listing::factory(10)->create();

    }
}
