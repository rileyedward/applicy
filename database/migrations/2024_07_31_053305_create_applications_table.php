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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('job_url');
            $table->string('position');
            $table->string('company_name');
            $table->string('location');
            $table->enum('environment', [
                'remote',
                'on-site',
                'hybrid'
            ]);
            $table->text('description');
            $table->enum('status', [
                'applied',
                'in_review',
                'coding_challenge',
                'interview_scheduled',
                'interviewed',
                'offer_extended',
                'offer_accepted',
                'offer_declined',
                'rejected',
                'withdrawn'
            ])->default('applied');
            $table->string('status')->default('applied');
            $table->date('submission_date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
