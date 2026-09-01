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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('venue');
            $table->string('city')->default('Jakarta, Indonesia');
            $table->string('hall')->nullable();
            $table->string('booth')->nullable();
            $table->string('dates');
            $table->string('opening_time')->default('09:00');
            $table->string('closing_time')->default('17:00');
            $table->string('timezone')->default('WIB');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
