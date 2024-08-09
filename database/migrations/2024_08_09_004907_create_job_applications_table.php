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
        $environments = config('applications.environments');
        $environmentEnums = array_map(fn ($env) => $env['value'], $environments);

        $statuses = config('applications.statuses');
        $statusEnums = array_map(fn ($status) => $status['value'], $statuses);

        Schema::create('job_applications', function (Blueprint $table) use ($environmentEnums, $statusEnums) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('job_url');
            $table->string('position');
            $table->string('company_name');
            $table->string('location');
            $table->enum('environment', $environmentEnums);
            $table->string('salary_range')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->timestamp('applied_at')->nullable();
            $table->enum('status', $statusEnums)->default('not_applied');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
