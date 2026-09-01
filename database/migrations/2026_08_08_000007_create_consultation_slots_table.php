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
        if (! Schema::hasTable('consultation_slots')) {
            Schema::create('consultation_slots', function (Blueprint $table) {
                $table->id();
                $table->foreignId('event_date_id')->constrained('event_dates')->onDelete('cascade');
                $table->string('start_time', 10);
                $table->string('end_time', 10);
                $table->integer('capacity')->default(3);
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->unique(['event_date_id', 'start_time']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_slots');
    }
};
