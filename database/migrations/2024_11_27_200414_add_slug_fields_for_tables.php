<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });

        Schema::table('meal_types', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });

        Schema::table('measure_types', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });

        Schema::table('recipes', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });

        Schema::table('instruments', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });

        Schema::table('cuisines', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });

        Schema::table('cooking_steps', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });

        Schema::table('ingredients', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('meal_types', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('measure_types', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('instruments', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('cuisines', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('cooking_steps', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
