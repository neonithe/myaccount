<?php

namespace Database\Seeders;

use App\Models\workout\Exercises;
use App\Models\workout\Workout;
use App\Models\workout\WorkoutArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkoutArea::create(['name'=>'Bröst']); //1
        WorkoutArea::create(['name'=>'Armar']); //2
        WorkoutArea::create(['name'=>'Ben']);   //3
        WorkoutArea::create(['name'=>'Triceps']);//4
        WorkoutArea::create(['name'=>'Rumpa']); //5
        WorkoutArea::create(['name'=>'Axlar']); //6
        WorkoutArea::create(['name'=>'Mage']); //7
        WorkoutArea::create(['name'=>'Rygg/Ben']); //8
        WorkoutArea::create(['name'=>'Rygg']); //9

        Workout::create(['user_id'=>1, 'workout_set'=>'Monday Leg', 'day'=>'Monday']);
        Workout::create(['user_id'=>1, 'workout_set'=>'Thuseday Arms', 'day'=>'Tuesday']);
        Workout::create(['user_id'=>1, 'workout_set'=>'Wednesday Chest', 'day'=>'Wednesday']);
        Workout::create(['user_id'=>1, 'workout_set'=>'Thursday Calastenics', 'day'=>'Thursday']);
        Workout::create(['user_id'=>1, 'workout_set'=>'Friday Core', 'day'=>'Friday']);

        Exercises::create(['user_id'=>1, 'exercise'=>'Armhävningar', 'link'=>'www.google.com', 'area_id'=>1]);
        Exercises::create(['user_id'=>1, 'exercise'=>'Situps', 'area_id'=>7]);
        Exercises::create(['user_id'=>1, 'exercise'=>'Marklyft', 'area_id'=>8]);
        Exercises::create(['user_id'=>1, 'exercise'=>'Stela marklyft', 'link'=>'www.google.com', 'area_id'=>9]);
        Exercises::create(['user_id'=>1, 'exercise'=>'Biceps curls', 'area_id'=>2]);
        Exercises::create(['user_id'=>1, 'exercise'=>'Leg extensions', 'area_id'=>3]);
        Exercises::create(['user_id'=>1, 'exercise'=>'Chest press', 'area_id'=>1]);
        Exercises::create(['user_id'=>1, 'exercise'=>'Bänkpress', 'area_id'=>1]);
        Exercises::create(['user_id'=>1, 'exercise'=>'Vadlyft', 'area_id'=>3]);
        Exercises::create(['user_id'=>1, 'exercise'=>'Knälyft', 'area_id'=>3]);
    }
}
