<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercise_workout', function (Blueprint $table) {
            $table->unsignedBigInteger('workout_id');
            $table->unsignedBigInteger('exercises_id');

            $table->integer('set')->default(3);
            $table->integer('rep')->default(8);
            $table->integer('weight');

            $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
            $table->foreign('exercises_id')->references('id')->on('exercises')->onDelete('cascade');

            $table->primary(['workout_id', 'exercises_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_workout');
    }
};
