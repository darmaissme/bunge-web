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
        if (! Schema::hasTable('event_dates')) {
            Schema::create('event_dates', function (Blueprint $table) {
                $table->id();
                $table->date('date')->unique();
                $table->boolean('is_active')->default(true);
                $table->integer('capacity')->default(36);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_dates');
    }
};
