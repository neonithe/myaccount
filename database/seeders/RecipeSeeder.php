<?php

namespace Database\Seeders;

use App\Models\recipe\Ingredient;
use App\Models\recipe\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{

    public function run(): void
    {
        $recipe = Recipe::create([
            'user_id'   =>1,
            'name'      => 'Pannkakor',
            'description' => 'Klassiska svenska pannkakor.',
            'link'      => 'www.google.com',
        ]);

        $recipe2 = Recipe::create([
            'user_id'       =>1,
            'name'          => 'Vofflor',
            'description'   => 'Klassiska vofflor.',
            'link'          => 'www.voffla.com',
            'portion'       => 4,
        ]);

        $flour  = Ingredient::create(['user_id'=>1, 'name' => 'Mjöl', 'calories' => 3, 'fat' => 4, 'carbs' => 5, 'sugars' => 6, 'protein' => 2, 'salt' => 0.0003]);
        $milk   = Ingredient::create(['user_id'=>1, 'name' => 'Mjölk', 'calories' => 5, 'fat' => 5, 'carbs' => 2, 'sugars' => 4, 'protein' => 0.00, 'salt' => 0.00]);
        $egg    = Ingredient::create(['user_id'=>1, 'name' => 'Ägg', 'calories' => 3, 'fat' => 1, 'carbs' => 3, 'sugars' => 4, 'protein' => 6, 'salt' => 3]);
        $butter = Ingredient::create(['user_id'=>1, 'name' => 'Smör', 'calories' => 7.1700, 'fat' => 0.81, 'carbs' => 0.0006, 'sugars' => 0.0006, 'protein' => 0.0085, 'salt' => 0.0003]);

        $recipe->ingredients()->attach($flour->id, ['volume' => 300, 'type_name' => 'g', 'gram' => 100]);
        $recipe->ingredients()->attach($milk->id, ['volume' => 500, 'type_name' => 'ml', 'gram' => 200]);
        $recipe->ingredients()->attach($egg->id, ['volume' => 50, 'type_name' => 'g', 'gram' => 300]);
        $recipe->ingredients()->attach($butter->id, ['volume' => 50, 'type_name' => 'g', 'gram' => 40]);

        $recipe2->ingredients()->attach($flour->id, ['volume' => 300, 'type_name' => 'g', 'gram' => 100]);
        $recipe2->ingredients()->attach($milk->id, ['volume' => 500, 'type_name' => 'ml', 'gram' => 200]);
        $recipe2->ingredients()->attach($egg->id, ['volume' => 50, 'type_name' => 'g', 'gram' => 300]);
    }
}
