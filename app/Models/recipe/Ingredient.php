<?php

namespace App\Models\recipe;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $guarded;

    public function recipes() {
        return $this->belongsToMany(Recipe::class, 'ingredient_recipe')
            ->withPivot('volume', 'type', 'calories', 'fat', 'carbs', 'sugars', 'protein', 'salt')
            ->withTimestamps();
    }
}
