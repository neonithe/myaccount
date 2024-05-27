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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');

            $table->integer('order');

            $table->string('name');
            $table->integer('project_type_id');

            $table->longText('link')->nullable();
            $table->longText('comment')->nullable();

            // Unactive projects or under planing (Estimates)
            $table->integer('size');
            $table->decimal('be_days', 8, 1)->nullable();
            $table->decimal('fe_days', 8, 1)->nullable();
            $table->decimal('ma_days', 8, 1)->nullable();
            $table->decimal('be_ot_days', 8, 1)->nullable();
            $table->decimal('fe_ot_days', 8, 1)->nullable();

            $table->decimal('be_perc', 8, 1)->nullable();
            $table->decimal('fe_perc', 8, 1)->nullable();
            $table->decimal('ma_perc', 8, 1)->nullable();
            $table->decimal('be_ot_perc', 8, 1)->nullable();
            $table->decimal('fe_ot_perc', 8, 1)->nullable();

            // Active
            $table->decimal('fe_points', 8, 1)->nullable();
            $table->decimal('be_points', 8, 1)->nullable();
            $table->decimal('fe_ot_points', 8, 1)->nullable();
            $table->decimal('be_ot_points', 8, 1)->nullable();

            $table->decimal('fe_progress_points', 8, 1)->nullable();
            $table->decimal('be_progress_points', 8, 1)->nullable();

            // Active projects
            $table->decimal('total_time', 8, 1)->nullable();
            $table->decimal('cost', 8, 1)->nullable();

            $table->integer('cycle_nr')->nullable();

            // From backlog
            $table->integer('prio')->nullable();
            $table->integer('quarter')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
