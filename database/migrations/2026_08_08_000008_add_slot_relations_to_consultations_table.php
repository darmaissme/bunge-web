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
        if (Schema::hasTable('consultations')) {
            Schema::table('consultations', function (Blueprint $table) {
                if (! Schema::hasColumn('consultations', 'event_date_id')) {
                    $table->foreignId('event_date_id')->nullable()->after('discussion_topic')->constrained('event_dates')->nullOnDelete();
                }
                if (! Schema::hasColumn('consultations', 'consultation_slot_id')) {
                    $table->foreignId('consultation_slot_id')->nullable()->after('event_date_id')->constrained('consultation_slots')->nullOnDelete();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('consultations')) {
            Schema::table('consultations', function (Blueprint $table) {
                if (Schema::hasColumn('consultations', 'consultation_slot_id')) {
                    $table->dropForeign(['consultation_slot_id']);
                    $table->dropColumn('consultation_slot_id');
                }
                if (Schema::hasColumn('consultations', 'event_date_id')) {
                    $table->dropForeign(['event_date_id']);
                    $table->dropColumn('event_date_id');
                }
            });
        }
    }
};
