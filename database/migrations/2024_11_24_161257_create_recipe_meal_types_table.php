<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipe_meal_types', function (Blueprint $table) {
            $table->foreignId('recipe_id')->constrained('recipes')->cascadeOnDelete();
            $table->foreignId('meal_type_id')->constrained('meal_types')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipe_meal_types');
    }
};
