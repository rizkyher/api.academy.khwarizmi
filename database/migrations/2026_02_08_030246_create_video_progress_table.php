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
Schema::create('video_progress', function (Blueprint $table) {
 $table->id();

 $table->foreignId('user_id')->constrained();
 $table->foreignId('lesson_video_id')->constrained();

 $table->integer('watched_seconds')->default(0);
 $table->boolean('completed')->default(false);

 $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_progress');
    }
};
