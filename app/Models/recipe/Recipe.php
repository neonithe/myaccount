<?php

namespace App\Models\recipe;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $guarded;

    public function ingredients() {
        return $this->belongsToMany(Ingredient::class, 'ingredient_recipe')
            ->withPivot('volume', 'type_name', 'gram')
            ->withTimestamps();
    }
}
