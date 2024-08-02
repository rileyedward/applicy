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
        Schema::table('application_actions', function (Blueprint $table) {
            $statusEnums = [
                'need_to_apply',
                'applied',
                'in_review',
                'coding_challenge',
                'interview_scheduled',
                'interviewed',
                'offer_extended',
                'offer_accepted',
                'offer_declined',
                'rejected',
                'withdrawn',
            ];

            $table->enum('previous_status', $statusEnums)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('application_actions', function (Blueprint $table) {
            $statusEnums = [
                'need_to_apply',
                'applied',
                'in_review',
                'coding_challenge',
                'interview_scheduled',
                'interviewed',
                'offer_extended',
                'offer_accepted',
                'offer_declined',
                'rejected',
                'withdrawn',
            ];

            $table->enum('previous_status', $statusEnums)->change();
        });
    }
};
