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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->boolean('default')->default(true);
            $table->longText('link');
            $table->longText('link_2')->nullable();

            $table->boolean('folder_link')->nullable();
            $table->boolean('document_link')->nullable();
            $table->boolean('app_link')->nullable();

            $table->string('cat_id')->nullable();
            $table->string('tag_id')->nullable();
            $table->boolean('fav')->default(false);

            $table->longText('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
