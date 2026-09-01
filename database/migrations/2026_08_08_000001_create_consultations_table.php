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
        if (! Schema::hasTable('consultations')) {
            Schema::create('consultations', function (Blueprint $table) {
                $table->id();
                $table->string('booking_number')->unique();
                $table->string('full_name');
                $table->string('phone');
                $table->string('email')->index();
                $table->string('company');
                $table->string('industry');
                $table->string('discussion_topic');
                $table->date('preferred_date')->index();
                $table->string('preferred_time');
                $table->text('notes')->nullable();
                $table->string('specialist')->nullable()->default('To be assigned');
                $table->string('duration')->nullable()->default('30 Menit');
                $table->string('status')->default('confirmed')->index();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
