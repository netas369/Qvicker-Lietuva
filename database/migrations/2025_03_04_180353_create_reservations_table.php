<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seeker_id')->constrained('users')->onDelete('cascade'); // Seeker user ID
            $table->foreignId('provider_id')->constrained('users')->onDelete('cascade'); // Provider user ID
            $table->date('reservation_date');
            $table->text('description');
            $table->string('address');
            $table->string('phone');
            $table->string('task_size');
            $table->string('subcategory')->nullable();
            $table->string('city');
            $table->enum('status', ['pending', 'accepted', 'declined', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
