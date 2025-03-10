<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->onDelete('cascade'); // Links to listings
            $table->string('email');
            $table->string('full_name');
            $table->string('year');
            $table->string('college');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('event_registrations');
    }
};
