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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');

            $table->string('name');
            // Nutritional information
            $table->decimal('calories', 10, 4)->nullable();
            $table->decimal('fat', 10, 4)->nullable();
            $table->decimal('carbs', 10, 4)->nullable();
            $table->decimal('sugars', 10, 4)->nullable();
            $table->decimal('protein', 10, 4)->nullable();
            $table->decimal('salt', 10, 4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
