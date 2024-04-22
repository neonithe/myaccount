<?php

namespace Database\Seeders;

use App\Models\todo\Todo;
use App\Models\todo\TodoState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Todo::create([
            'user_id'       =>  1,
            'todo'          =>  'Dev meeting',
            'meeting'       =>  true,
            'remind_time'   =>  '09:00',
            'remind_day'    =>  'Monday',
        ]);

        Todo::create([
            'user_id'       =>  1,
            'todo'          =>  'Dev meeting',
            'link'          =>  'meet.google.com/fne-eckw-aft',
            'meeting'       =>  true,
            'remind_time'   =>  '09:00',
            'remind_day'    =>  'Wednesday',
        ]);

        Todo::create([
            'user_id'       =>  1,
            'todo'          =>  'Dev meeting',
            'meeting'       =>  true,
            'remind_time'   =>  '09:00',
            'remind_day'    =>  'Friday',
        ]);

        Todo::create([
            'user_id'       =>  1,
            'todo'          =>  'Company meeting',
            'link'          =>  'meet.google.com/ggv-gmrz-cwu',
            'meeting'       =>  true,
            'remind_time'   =>  '10:00',
            'remind_day'    =>  'Wednesday',
            'comment'       =>  'Uppdatera roadmap och filen som presenteras.',
        ]);

        Todo::create([
            'user_id'       =>  1,
            'todo'          =>  'Product meeting',
            'link'          =>  'meet.google.com/cob-mwaj-hzc',
            'meeting'       =>  true,
            'remind_time'   =>  '11:00',
            'remind_day'    =>  'Wednesday',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Topplockspackning',
            'notice'        =>  true,
            'link'          =>  'https://maskinexperten.com/ok-reservdelar/',
            'comment'       =>  'Ringa Stefan efter hur man kan få tag i topplockspackning till grävare. De kunde inte hjälpa mig med topplocket. Dock hittade jag en ny sida.',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Guidelines Linear',
            'link'          =>  'https://docs.google.com/document/d/1nCn8V0ZbtuHZILBAt2kFEBgA9fT4JKolKwk22fpspWI/edit#heading=h.9u79u5j10wu5',
            'comment'       =>  'Har gjort version 1',
        ]);

    }
}
