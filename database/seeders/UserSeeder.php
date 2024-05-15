<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    protected static ?string $password;

    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'Mattias Andersson',
            'email' => 'neonithe@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),

        ]);
        Settings::create(['user_id' => 1,
            'access'            => 'admin',

            'start_cycle'       => '2024-03-25',
            'length_cycle'      => 2,
            'nr_cycle'          => 13,
            'show_nr_of_cycle'  => 12,
            'private'           => true,

            'access_topinfo'    => true,
            'access_eco'        => true,
            'access_link'       => true,
            'access_recipe'     => true,
            'access_workout'    => true,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Martin Zimmerman',
            'email' => 'martin@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),

        ]);
        Settings::create(['user_id' => 2,
            'access'            => 'admin',

            'start_cycle'       => '2024-03-25',
            'length_cycle'      => 2,
            'nr_cycle'          => 13,
            'show_nr_of_cycle'  => 12,

            'access_topinfo'    => true,
            'access_eco'        => false,
            'access_link'       => false,
            'access_recipe'     => false,
            'access_workout'    => false,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Sofia Sonesson',
            'email' => 'sofia@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),

        ]);
        Settings::create(['user_id' => 3,
            'access'            => 'admin',

            'start_cycle'       => '2024-03-25',
            'length_cycle'      => 2,
            'nr_cycle'          => 13,
            'show_nr_of_cycle'  => 12,

            'access_topinfo'    => true,
            'access_eco'        => false,
            'access_link'       => false,
            'access_recipe'     => false,
            'access_workout'    => false,
        ]);
    }
}
