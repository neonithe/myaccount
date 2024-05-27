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
        Schema::create('project_backlogs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');

            $table->string('name');
            $table->integer('project_type_id');
            $table->integer('prio');
            $table->integer('quarter');
            $table->integer('size');

            $table->decimal('be_perc', 8, 1)->nullable();
            $table->decimal('fe_perc', 8, 1)->nullable();

            $table->longText('link')->nullable();
            $table->longText('comment')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_backlogs');
    }
};
