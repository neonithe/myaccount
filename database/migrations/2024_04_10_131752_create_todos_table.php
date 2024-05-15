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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->longText('todo')->nullable();
            $table->boolean('done')->default(false);

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('link')->nullable();

            $table->date('remind_date')->nullable();
            $table->time('remind_time')->nullable();
            $table->string('remind_day')->nullable();
            $table->date('repeat')->nullable();

            $table->longText('comment')->nullable();

            //States
            $table->boolean('notice')->default(false);
            $table->boolean('paused')->default(false);
            $table->boolean('meeting')->default(false);
            $table->boolean('contact')->default(false);

            //Type of mytodo - regular/private
            $table->boolean('private')->default(false);

            $table->date('done_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
