<?php

namespace Database\Seeders;

use App\Models\econmony\CryptoInvestment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CryptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CryptoInvestment::create(['user_id' => 1, 'name' => 'btc', 'value' => 0.06718432, 'buy_value_sek' => 35000]);
        CryptoInvestment::create(['user_id' => 1, 'name' => 'xrp', 'value' => 2093.66835075, 'buy_value_sek' => 12000]);
        CryptoInvestment::create(['user_id' => 1, 'name' => 'eth', 'value' => 0, 'buy_value_sek' => 0, 'comment' => 'Ska investera i']);
        CryptoInvestment::create(['user_id' => 1, 'name' => 'btc', 'value' => 0.22315150, 'buy_value_sek' => 86000, 'comment' => 'Sofias BTC investering']);
    }
}
