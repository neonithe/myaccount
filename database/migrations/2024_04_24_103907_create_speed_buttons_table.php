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
        Schema::create('speed_buttons', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('order')->nullable();
            $table->integer('button_id')->nullable();
            $table->integer('link_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speed_buttons');
    }
};
