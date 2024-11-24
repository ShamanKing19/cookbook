<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ingredients_pictures', function (Blueprint $table) {
            $table->foreignId('ingredient_id')->constrained('ingredients', 'id')->cascadeOnDelete();
            $table->foreignId('picture_id')->constrained('attachments', 'id')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingredients_pictures');
    }
};
