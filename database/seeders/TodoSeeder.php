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
            'todo'          =>  'Företagsreglerna',
        ]);

        Todo::create([
            'user_id'       =>  1,
            'todo'          =>  'Agenda möte produkt',
        ]);

        Todo::create([
            'user_id'       =>  1,
            'todo'          =>  'Rollbeskrvningarna',
        ]);

        Todo::create([
            'user_id'       =>  1,
            'todo'          =>  'Lista till Martin OKR',
            'remind_date'   =>  '2024-03-14',
        ]);

        Todo::create([
            'user_id'       =>  1,
            'todo'          =>  'TEST TIME',
            'meeting'       =>  true,
            'remind_date'   =>  '2024-03-18',
            'remind_time'   =>  '14:00:00',
        ]);

        Todo::create([
            'user_id'       =>  1,
            'todo'          =>  'TEST REPEAT2',
            'repeat'        =>  '2024-03-18',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Skicka mail till Digiredo',
            'notice'        =>  true,
            'done'          =>  true,
            'done_date'     =>  '2024-03-25',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Skicka support mail ang abonnemang',
            'notice'        =>  true,
            'done'          =>  true,
            'done_date'     =>  '2024-03-25',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Skapa skuldebrev',
            'notice'        =>  true,
            'done'          =>  true,
            'done_date'     =>  '2024-03-25',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Topplockspackning',
            'notice'        =>  true,
            'link'          =>  'https://maskinexperten.com/ok-reservdelar/',
            'comment'       =>  'Ringa Stefan efter hur man kan få tag i topplockspackning till grävare. De kunde inte hjälpa mig med topplocket. Dock hittade jag en ny sida.',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Fixa skatten idag',
            'remind_date'   =>  '2024-03-25',
            'done'          =>  true,
            'done_date'     =>  '2024-03-25',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Vem är det som hanterar front-end error?',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Gå igenom OKR',
            'link'          =>  'https://docs.google.com/document/d/1ZPudWdB3L-LFu5sbbXLBQQ1DjJyeF0NnjLMoLqP3hJ0/edit',
            'comment'       =>  'Har skickat till Martin',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Beställa bok',
            'link'          =>  'https://nordicpreparation.com/bocker-information/matlagningens-grunder?_gl=1*1itgo66*_up*MQ..&gclid=CjwKCAjwh4-wBhB3EiwAeJsppOAKTI-5VbvwRR-xHdGqSaSKVeKj1j8BVmzfU5QZ4AblOBD5VB-SgRoCkbwQAvD_BwE',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Guidelines Linear',
            'link'          =>  'https://docs.google.com/document/d/1nCn8V0ZbtuHZILBAt2kFEBgA9fT4JKolKwk22fpspWI/edit#heading=h.9u79u5j10wu5',
            'comment'       =>  'Har gjort version 1',
        ]);

        Todo::create(['user_id'       =>  1,
            'todo'          =>  'Lägga in ang semestern',
            'comment'       =>  'Har lagt in semesterledigt',
        ]);

    }
}
