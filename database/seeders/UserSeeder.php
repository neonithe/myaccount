<?php

namespace Database\Seeders;

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

        \App\Models\User::factory()->create([
            'name' => 'Martin Zimmerman',
            'email' => 'martin@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),

        ]);

        \App\Models\User::factory()->create([
            'name' => 'Sofia Sonesson',
            'email' => 'sofia@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),

        ]);
    }
}
