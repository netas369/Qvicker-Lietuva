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
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('lastname')->after('name')->nullable();
                $table->date('birthday')->after('lastname')->nullable();
                $table->string('address')->after('birthday')->nullable();
                $table->string('city')->after('address')->nullable();
                $table->string('subcategories')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['lastname', 'birthday', 'address', 'city']);
        });
    }
};
