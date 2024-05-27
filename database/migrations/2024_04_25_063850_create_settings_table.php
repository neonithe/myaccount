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

            //Access
            $table->boolean('private')->default(false);

            $table->date('start_cycle')->nullable();
            $table->integer('length_cycle')->nullable();
            $table->integer('nr_cycle')->nullable();
            $table->integer('show_nr_of_cycle')->nullable();

            $table->string('button_align')->default('right');

            // Active
            $table->boolean('access_topinfo')->default(true);
            $table->boolean('access_eco')->default(false);
            $table->boolean('access_link')->default(false);
            $table->boolean('access_recipe')->default(false);
            $table->boolean('access_workout')->default(false);

            // Dash link
            $table->boolean('dash_link')->default(false);

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
