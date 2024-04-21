<?php

namespace App\Models\workout;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $guarded;

    public function exercise() {
        return $this->belongsToMany(Exercises::class, 'exercise_workout')
            ->withPivot('set', 'rep', 'weight')
            ->withTimestamps();
    }
}
