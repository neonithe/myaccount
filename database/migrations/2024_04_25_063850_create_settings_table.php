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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->string('access')->default('user');

            $table->date('start_cycle')->default('2024-03-25');
            $table->integer('length_cycle')->default(2);
            $table->integer('nr_cycle')->default(13);
            $table->integer('show_nr_of_cycle')->default(12);

            $table->string('button_align')->default('left');

            // Active
            $table->boolean('access_topinfo')->default(true);
            $table->boolean('access_eco')->default(false);
            $table->boolean('access_link')->default(false);
            $table->boolean('access_recipe')->default(false);
            $table->boolean('access_workout')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
