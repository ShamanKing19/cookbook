<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_id')->constrained('meals', 'id')->cascadeOnDelete();
            $table->longText('description')->nullable();
            $table->integer('cooking_time')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('users', 'id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
