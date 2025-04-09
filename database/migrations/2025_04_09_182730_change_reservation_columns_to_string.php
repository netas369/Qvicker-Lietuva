<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeReservationColumnsToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // You'll need the doctrine/dbal package for column changes
        // composer require doctrine/dbal

        Schema::table('reservations', function (Blueprint $table) {
            // Change status from ENUM to string
            DB::statement("ALTER TABLE reservations MODIFY COLUMN status VARCHAR(30)");

            // Change cancellation_reason from ENUM to string
            DB::statement("ALTER TABLE reservations MODIFY COLUMN cancellation_reason VARCHAR(50)");

            // Change cancelled_by from ENUM to string
            DB::statement("ALTER TABLE reservations MODIFY COLUMN cancelled_by VARCHAR(20)");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Revert status back to ENUM
            DB::statement("ALTER TABLE reservations MODIFY COLUMN status ENUM('pending','accepted','declined','completed','canceled')");

            // Revert cancellation_reason back to ENUM
            DB::statement("ALTER TABLE reservations MODIFY COLUMN cancellation_reason ENUM('provider_personal_circumstances','provider_health_issues','technical_issues','weather_conditions','insufficient_participants','location_change','previous_booking_extended','qualification_issues','seeker_change_of_plans','seeker_health_issues','changed_mind','found_alternative','financial_reasons','transportation_issues','weather_conditions_seeker','service_no_longer_needed')");

            // Revert cancelled_by back to ENUM (Add your current values here)
            // Example:
            DB::statement("ALTER TABLE reservations MODIFY COLUMN cancelled_by ENUM('provider','seeker')");
        });
    }
}
