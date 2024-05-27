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
        Schema::create('planing_settings', function (Blueprint $table) {
            $table->id();

            $table->integer('work_day_hours');
            $table->integer('days_in_week');
            $table->integer('cycle_weeks');

            $table->decimal('points_per_hour', 8, 1)->nullable();
            $table->decimal('focus_factor', 8, 1)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planing_settings');
    }
};
