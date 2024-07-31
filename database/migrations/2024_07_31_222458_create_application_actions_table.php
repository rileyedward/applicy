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
        Schema::create('application_actions', function (Blueprint $table) {
            $statusEnums = [
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

            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('application_id')->constrained('applications')->cascadeOnDelete();
            $table->string('title');
            $table->enum('previous_status', $statusEnums);
            $table->enum('new_status', $statusEnums);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_actions');
    }
};
