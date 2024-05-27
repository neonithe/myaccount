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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('cost_h');
            $table->integer('work_time_perc');
            $table->integer('cycle_work_time_perc');

            $table->integer('team_id')->nullable();

            // Calculated Data
            $table->decimal('cycle_days', 8, 1)->nullable();
            $table->decimal('cycle_work_h', 8, 1)->nullable();
            $table->decimal('cycle_points', 8, 1)->nullable();
            $table->decimal('real_cycle_work_h', 8, 1)->nullable();
            $table->decimal('real_cycle_points', 8, 1)->nullable();
            $table->decimal('real_cycle_points_h', 8, 2)->nullable();
            $table->decimal('man_days', 8, 1)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
