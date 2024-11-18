<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes_instruments', function (Blueprint $table) {
            $table->foreignId('recipe_id')->constrained('recipes', 'id')->cascadeOnDelete();
            $table->foreignId('instrument_id')->constrained('instruments', 'id')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes_instruments');
    }
};
