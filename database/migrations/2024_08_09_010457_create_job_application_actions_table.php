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
        $statuses = config('applications.statuses');
        $statusEnums = array_map(fn ($status) => $status['value'], $statuses);

        Schema::create('job_application_actions', function (Blueprint $table) use ($statusEnums) {
            $table->id();
            $table->foreignId('job_application_id')->constrained('job_applications')->cascadeOnDelete();
            $table->string('title');
            $table->enum('previous_status', $statusEnums)->nullable();
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
        Schema::dropIfExists('job_application_actions');
    }
};
