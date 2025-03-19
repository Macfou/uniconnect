<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            // Change classification to JSON for multiple selections
            $table->json('classification')->nullable();

            // Keep status as enum
            $table->enum('status', ['Available', 'Unavailable'])->default('Available');
        });
    }

    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn(['classification', 'status']);
        });
    }
};
