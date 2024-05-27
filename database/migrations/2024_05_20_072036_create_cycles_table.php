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
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');

            $table->string('name');

            $table->integer('cycle_nr');
            $table->date('cycle_start')->nullable();
            $table->date('cycle_end')->nullable();

            $table->decimal('fe_days', 8, 1)->nullable();
            $table->decimal('be_days', 8, 1)->nullable();

            $table->decimal('time', 8, 1)->nullable();
            $table->integer('team_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
