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
        Schema::create('rides', function (Blueprint $table) {
            $table->id('ride_id');
            $table->string('name', 100);
            $table->text('description');
            $table->unsignedSmallInteger('duration_minutes');
            $table->unsignedInteger('price');
            $table->string('difficulty', 20);
            $table->string('cover')->nullable();
            $table->string('cover_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
