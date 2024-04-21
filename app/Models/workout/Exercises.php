<?php

namespace App\Models\workout;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercises extends Model
{
    use HasFactory;

    protected $guarded;

    public function workouts() {
        return $this->belongsToMany(Workout::class, 'exercise_workout')
            ->withPivot('set', 'rep', 'weight')
            ->withTimestamps();
    }
}
