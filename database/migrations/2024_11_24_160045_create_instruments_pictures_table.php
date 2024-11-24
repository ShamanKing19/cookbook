<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instruments_pictures', function (Blueprint $table) {
            $table->foreignId('instrument_id')->constrained('instruments')->cascadeOnDelete();
            $table->foreignId('picture_id')->constrained('attachments')->cascadeOnDelete();
            $table->integer('sort');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instruments_pictures');
    }
};
