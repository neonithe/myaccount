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

        // Ingredients
        $ing1 = Ingredient::create(['user_id'=>1, 'name' => 'Kycklinglår']);
        $ing2 = Ingredient::create(['user_id'=>1, 'name' => 'Gul lök']);
        $ing3 = Ingredient::create(['user_id'=>1, 'name' => 'Vitlök']);
        $ing4 = Ingredient::create(['user_id'=>1, 'name' => 'Smör', 'calories' => 7.1700, 'fat' => 0.81, 'carbs' => 0.0006, 'sugars' => 0.0006, 'protein' => 0.0085, 'salt' => 0.0003]);
        $ing5 = Ingredient::create(['user_id'=>1, 'name' => 'Tomatpuré']);
        $ing6 = Ingredient::create(['user_id'=>1, 'name' => 'Mango chutney']);
        $ing7 = Ingredient::create(['user_id'=>1, 'name' => 'Hönsbuljong']);
        $ing8 = Ingredient::create(['user_id'=>1, 'name' => 'Syrad grädde']);
        $ing9 = Ingredient::create(['user_id'=>1, 'name' => 'Vatten']);

        $ing11 = Ingredient::create(['user_id'=>1, 'name' => 'Champinjoner']);
        $ing12 = Ingredient::create(['user_id'=>1, 'name' => 'Matolja']);
        $ing13 = Ingredient::create(['user_id'=>1, 'name' => 'Chorizo']);
        $ing14 = Ingredient::create(['user_id'=>1, 'name' => 'Paprika']);
        $ing15 = Ingredient::create(['user_id'=>1, 'name' => 'Ketchup']);
        $ing16 = Ingredient::create(['user_id'=>1, 'name' => 'Grädde']);

        $ing17 = Ingredient::create(['user_id'=>1, 'name' => 'Kalvfond']);
        $ing18 = Ingredient::create(['user_id'=>1, 'name' => 'Dijonsenap']);
        $ing19 = Ingredient::create(['user_id'=>1, 'name' => 'Kyckling']);
        $ing20 = Ingredient::create(['user_id'=>1, 'name' => 'Röd chili']);
        $ing21 = Ingredient::create(['user_id'=>1, 'name' => 'Honung']);
        $ing22 = Ingredient::create(['user_id'=>1, 'name' => 'Soya']);

        $ing23 = Ingredient::create(['user_id'=>1, 'name' => 'Pasta penne']);
        $ing24 = Ingredient::create(['user_id'=>1, 'name' => 'Rökt skinka']);
        $ing25 = Ingredient::create(['user_id'=>1, 'name' => 'Tomatsås arabiata']);
        $ing26 = Ingredient::create(['user_id'=>1, 'name' => 'Kelda pastasås mild ost']);
        $ing27 = Ingredient::create(['user_id'=>1, 'name' => 'Riven ost mager']);
        $ing28 = Ingredient::create(['user_id'=>1, 'name' => 'Socker']);

        $ing29 = Ingredient::create(['user_id'=>1, 'name' => 'Srirachasås']);
        $ing30 = Ingredient::create(['user_id'=>1, 'name' => 'Risvinäger']);
        $ing31 = Ingredient::create(['user_id'=>1, 'name' => 'Fisksås']);
        $ing32 = Ingredient::create(['user_id'=>1, 'name' => 'Tamarisoja']);
        $ing33 = Ingredient::create(['user_id'=>1, 'name' => 'Lime']);
        $ing34 = Ingredient::create(['user_id'=>1, 'name' => 'Nudlar']);
        $ing35 = Ingredient::create(['user_id'=>1, 'name' => 'Böngroddar']);
        $ing36 = Ingredient::create(['user_id'=>1, 'name' => 'Salladslök']);
        $ing37 = Ingredient::create(['user_id'=>1, 'name' => 'Ägg']);
        $ing38 = Ingredient::create(['user_id'=>1, 'name' => 'Jordnötter']);
        $ing39 = Ingredient::create(['user_id'=>1, 'name' => 'Färsk koriander']);

        $ing40 = Ingredient::create(['user_id'=>1, 'name' => 'Rostad lök']);
        $ing41 = Ingredient::create(['user_id'=>1, 'name' => 'Crème fraiche tomat basil']);
        $ing42 = Ingredient::create(['user_id'=>1, 'name' => 'Räkor']);
        $ing43 = Ingredient::create(['user_id'=>1, 'name' => 'Vitlöksost']);
        $ing44 = Ingredient::create(['user_id'=>1, 'name' => 'Durumvete']);
        $ing45 = Ingredient::create(['user_id'=>1, 'name' => 'Nötkött']);
        $ing46 = Ingredient::create(['user_id'=>1, 'name' => 'Morötter']);
        $ing47 = Ingredient::create(['user_id'=>1, 'name' => 'Palsternacka']);
        $ing48 = Ingredient::create(['user_id'=>1, 'name' => 'Rotcelleri']);
        $ing49 = Ingredient::create(['user_id'=>1, 'name' => 'Svartvinbärssaft']);
        $ing50 = Ingredient::create(['user_id'=>1, 'name' => 'Potatis']);
        $ing51 = Ingredient::create(['user_id'=>1, 'name' => 'Mjölk']);
        $ing52 = Ingredient::create(['user_id'=>1, 'name' => 'Mjöl']);

        // Kryddor
        $krd1 = Ingredient::create(['user_id'=>1, 'name' => 'Curry']);
        $krd2 = Ingredient::create(['user_id'=>1, 'name' => 'Paprikapulver']);
        $krd3 = Ingredient::create(['user_id'=>1, 'name' => 'Salt']);

        $krd5 = Ingredient::create(['user_id'=>1, 'name' => 'Oregano']);
        $krd6 = Ingredient::create(['user_id'=>1, 'name' => 'Grillkrydda']);
        $krd7 = Ingredient::create(['user_id'=>1, 'name' => 'Chiliflakes']);
        $krd8 = Ingredient::create(['user_id'=>1, 'name' => 'Vitpeppar']);

        // Recept
        $recipe1 = Recipe::create(['user_id' =>1, 'name' => 'Currykyckling', 'portion' => 4]);
        $recipe1->ingredients()->attach($ing1->id, ['volume' => 450, 'type_name' => 'g', 'gram' => 450]);
        $recipe1->ingredients()->attach($krd1->id, ['volume' => 2, 'type_name' => 'msk', 'gram' => 5]);
        $recipe1->ingredients()->attach($krd2->id, ['volume' => 1, 'type_name' => 'msk', 'gram' => 2.5]);
        $recipe1->ingredients()->attach($krd3->id, ['volume' => 1, 'type_name' => 'tsk', 'gram' => 1]);
        $recipe1->ingredients()->attach($ing2->id, ['volume' => 2, 'type_name' => 'st', 'gram' => 100]);
        $recipe1->ingredients()->attach($ing3->id, ['volume' => 2, 'type_name' => 'st', 'gram' => 10]);
        $recipe1->ingredients()->attach($ing4->id, ['volume' => 2, 'type_name' => 'msk', 'gram' => 20]);
        $recipe1->ingredients()->attach($ing5->id, ['volume' => 2, 'type_name' => 'msk', 'gram' => 10]);
        $recipe1->ingredients()->attach($ing6->id, ['volume' => 2, 'type_name' => 'msk', 'gram' => 10]);
        $recipe1->ingredients()->attach($ing7->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 5]);
        $recipe1->ingredients()->attach($ing9->id, ['volume' => 2, 'type_name' => 'dl', 'gram' => 200]);
        $recipe1->ingredients()->attach($ing8->id, ['volume' => 3, 'type_name' => 'dl', 'gram' => 300]);

        $recipe2 = Recipe::create(['user_id' =>1, 'name' => 'Korvgryta', 'portion' => 4]);
        $recipe2->ingredients()->attach($ing11->id, ['volume' => 200, 'type_name' => 'g', 'gram' => 200]);
        $recipe2->ingredients()->attach($ing12->id, ['volume' => 20, 'type_name' => 'g', 'gram' => 20]);
        $recipe2->ingredients()->attach($ing2->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 50]);
        $recipe2->ingredients()->attach($ing3->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 10]);
        $recipe2->ingredients()->attach($ing13->id, ['volume' => 300, 'type_name' => 'g', 'gram' => 300]);
        $recipe2->ingredients()->attach($ing14->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 50]);
        $recipe2->ingredients()->attach($ing15->id, ['volume' => 1, 'type_name' => 'dl', 'gram' => 100]);
        $recipe2->ingredients()->attach($ing16->id, ['volume' => 2, 'type_name' => 'dl', 'gram' => 200]);
        $recipe2->ingredients()->attach($ing17->id, ['volume' => 1, 'type_name' => 'msk', 'gram' => 10]);
        $recipe2->ingredients()->attach($ing18->id, ['volume' => 1, 'type_name' => 'msk', 'gram' => 10]);
        $recipe2->ingredients()->attach($krd5->id, ['volume' => 2, 'type_name' => 'tsk', 'gram' => 20]);

        $recipe3 = Recipe::create(['user_id' =>1, 'name' => 'Hel kyckling', 'portion' => 4]);
        $recipe3->ingredients()->attach($ing19->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 300]);
        $recipe3->ingredients()->attach($ing3->id, ['volume' => 3, 'type_name' => 'st', 'gram' => 15]);
        $recipe3->ingredients()->attach($ing20->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 10]);
        $recipe3->ingredients()->attach($krd6->id, ['volume' => 1, 'type_name' => 'tsk', 'gram' => 20]);
        $recipe3->ingredients()->attach($ing21->id, ['volume' => 1, 'type_name' => 'tsk', 'gram' => 20]);
        $recipe3->ingredients()->attach($ing15->id, ['volume' => 1, 'type_name' => 'tsk', 'gram' => 20]);
        $recipe3->ingredients()->attach($ing12->id, ['volume' => 1, 'type_name' => 'tsk', 'gram' => 20]);
        $recipe3->ingredients()->attach($ing22->id, ['volume' => 1, 'type_name' => 'tsk', 'gram' => 20]);
        $recipe3->ingredients()->attach($krd7->id, ['volume' => 1, 'type_name' => 'tsk', 'gram' => 20]);

        $recipe4 = Recipe::create(['user_id' =>1, 'name' => 'Pasta gratäng', 'portion' => 4]);
        $recipe4->ingredients()->attach($ing23->id, ['volume' => 300, 'type_name' => 'g', 'gram' => 300]);
        $recipe4->ingredients()->attach($ing24->id, ['volume' => 150, 'type_name' => 'g', 'gram' => 150]);
        $recipe4->ingredients()->attach($ing25->id, ['volume' => 3, 'type_name' => 'dl', 'gram' => 20]);
        $recipe4->ingredients()->attach($ing26->id, ['volume' => 2.5, 'type_name' => 'dl', 'gram' => 20]);
        $recipe4->ingredients()->attach($ing27->id, ['volume' => 1, 'type_name' => 'dl', 'gram' => 20]);

        $recipe5 = Recipe::create(['user_id' =>1, 'name' => 'Pad thai', 'portion' => 4]);
        $recipe5->ingredients()->attach($ing28->id, ['volume' => 1, 'type_name' => 'msk', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing9->id, ['volume' => 2, 'type_name' => 'msk', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing29->id, ['volume' => 1, 'type_name' => 'msk', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing30->id, ['volume' => 1, 'type_name' => 'msk', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing31->id, ['volume' => 2, 'type_name' => 'msk', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing32->id, ['volume' => 2, 'type_name' => 'msk', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing33->id, ['volume' => 1, 'type_name' => 'msk', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing34->id, ['volume' => 250, 'type_name' => 'g', 'gram' => 250]);
        $recipe5->ingredients()->attach($ing35->id, ['volume' => 180, 'type_name' => 'g', 'gram' => 180]);
        $recipe5->ingredients()->attach($ing36->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing37->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing20->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing3->id, ['volume' => 2, 'type_name' => 'st', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing42->id, ['volume' => 200, 'type_name' => 'g', 'gram' => 200]);
        $recipe5->ingredients()->attach($ing4->id, ['volume' => 2, 'type_name' => 'st', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing38->id, ['volume' => 2, 'type_name' => 'msk', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing39->id, ['volume' => 1, 'type_name' => 'dl', 'gram' => 0]);
        $recipe5->ingredients()->attach($ing40->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 0]);
        $recipe5->ingredients()->attach($krd7->id, ['volume' => 1, 'type_name' => 'tsk', 'gram' => 0]);

        $recipe6 = Recipe::create(['user_id' =>1, 'name' => 'Past med sås', 'portion' => 4]);
        $recipe6->ingredients()->attach($ing41->id, ['volume' => 3, 'type_name' => 'st', 'gram' => 0]);
        $recipe6->ingredients()->attach($ing42->id, ['volume' => 100, 'type_name' => 'g', 'gram' => 100]);
        $recipe6->ingredients()->attach($ing43->id, ['volume' => 1, 'type_name' => 'pkt', 'gram' => 0]);
        $recipe6->ingredients()->attach($ing13->id, ['volume' => 2, 'type_name' => 'st', 'gram' => 0]);

        $recipe7 = Recipe::create(['user_id' =>1, 'name' => 'Köttgryta', 'portion' => 4]);
        $recipe7->ingredients()->attach($ing45->id, ['volume' => 1.5, 'type_name' => 'kg', 'gram' => 0]);
        $recipe7->ingredients()->attach($ing46->id, ['volume' => 3, 'type_name' => 'st', 'gram' => 0]);
        $recipe7->ingredients()->attach($ing47->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 0]);
        $recipe7->ingredients()->attach($ing48->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 0]);
        $recipe7->ingredients()->attach($ing49->id, ['volume' => 3, 'type_name' => 'dl', 'gram' => 0]);
        $recipe7->ingredients()->attach($ing9->id, ['volume' => 5, 'type_name' => 'dl', 'gram' => 0]);
        $recipe7->ingredients()->attach($ing2->id, ['volume' => 1, 'type_name' => 'st', 'gram' => 0]);
        $recipe7->ingredients()->attach($ing3->id, ['volume' => 3, 'type_name' => 'st', 'gram' => 0]);
        $recipe7->ingredients()->attach($ing5->id, ['volume' => 1, 'type_name' => 'msk', 'gram' => 0]);
        $recipe7->ingredients()->attach($ing22->id, ['volume' => 1.5, 'type_name' => 'msk', 'gram' => 0]);
        $recipe7->ingredients()->attach($ing17->id, ['volume' => 0.5, 'type_name' => 'dl', 'gram' => 0]);

        $recipe8 = Recipe::create(['user_id' =>1, 'name' => 'Egen pasta', 'portion' => 4]);
        $recipe8->ingredients()->attach($ing44->id, ['volume' => 5, 'type_name' => 'dl', 'gram' => 0]);
        $recipe8->ingredients()->attach($ing37->id, ['volume' => 4, 'type_name' => 'st', 'gram' => 0]);

        $recipe9 = Recipe::create(['user_id' =>1, 'name' => 'Potatismos', 'portion' => 4]);
        $recipe9->ingredients()->attach($ing50->id, ['volume' => 12, 'type_name' => 'st', 'gram' => 0]);
        $recipe9->ingredients()->attach($ing4->id, ['volume' => 1, 'type_name' => 'msk', 'gram' => 0]);
        $recipe9->ingredients()->attach($ing51->id, ['volume' => 1, 'type_name' => 'dl', 'gram' => 0]);
        $recipe9->ingredients()->attach($krd8->id, ['volume' => 2, 'type_name' => 'krm', 'gram' => 0]);
        $recipe9->ingredients()->attach($krd3->id, ['volume' => 1, 'type_name' => 'krm', 'gram' => 0]);

    }
}
