<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cooking_steps_attachments', function (Blueprint $table) {
            $table->foreignId('cooking_step_id')->constrained('cooking_steps', 'id')->cascadeOnDelete();
            $table->foreignId('attachment_id')->constrained('attachments', 'id')->cascadeOnDelete();
            $table->integer('sort');
            $table->string('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cooking_steps_attachments');
    }
};
