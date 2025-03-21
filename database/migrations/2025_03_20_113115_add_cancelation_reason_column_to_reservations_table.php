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
        Schema::table('reservations', function (Blueprint $table) {
            $table->enum('cancellation_reason', [
                // Provider reasons
                'provider_personal_circumstances',
                'provider_health_issues',
                'technical_issues',
                'weather_conditions',
                'insufficient_participants',
                'location_change',
                'previous_booking_extended',
                'qualification_issues',

                // Seeker reasons
                'seeker_change_of_plans',
                'seeker_health_issues',
                'changed_mind',
                'found_alternative',
                'financial_reasons',
                'transportation_issues',
                'weather_conditions_seeker',
                'service_no_longer_needed'
            ])->nullable();

            $table->string('cancellation_details')->nullable();
            $table->enum('cancelled_by', ['provider', 'seeker'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('cancellation_reason');
            $table->dropColumn('cancellation_details');
            $table->dropColumn('cancelled_by');
        });
    }
};
