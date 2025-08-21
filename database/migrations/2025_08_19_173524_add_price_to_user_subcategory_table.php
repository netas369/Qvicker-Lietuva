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
        Schema::table('user_subcategory', function (Blueprint $table) {
            $table->integer('price');
            $table->enum('type', ['hourly', 'fixed', 'meter']);
            $table->integer('experience')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_subcategory', function (Blueprint $table) {
            $table->dropColumn('price', 'type', 'experience');
        });
    }
};
