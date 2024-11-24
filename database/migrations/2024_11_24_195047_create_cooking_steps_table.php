<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cooking_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes', 'id')->cascadeOnDelete();
            $table->text('description');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cooking_steps');
    }
};
