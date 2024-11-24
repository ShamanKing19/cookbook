<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes_ingredients', function (Blueprint $table) {
            $table->foreignId('recipe_id')->constrained('recipes', 'id')->cascadeOnDelete();
            $table->foreignId('ingredient_id')->constrained('ingredients', 'id')->cascadeOnDelete();
            $table->float('amount');
            $table->foreignId('measure_type_id')->constrained('measure_types', 'id')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes_ingredients');
    }
};
