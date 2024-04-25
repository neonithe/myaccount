<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create(['user_id' => 1,
            'access'            => 'admin',

            'start_cycle'       => '2024-03-25',
            'length_cycle'      => 2,
            'nr_cycle'          => 13,
            'show_nr_of_cycle'  => 12,

            'access_topinfo'    => true,
            'access_eco'        => true,
            'access_link'       => true,
            'access_recipe'     => true,
            'access_workout'    => true,
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
