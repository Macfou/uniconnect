<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('event_timings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listing_id');
            $table->timestamp('time_start')->nullable();
            $table->timestamp('time_end')->nullable();
            $table->integer('event_duration')->nullable(); // Store duration in seconds
            $table->timestamps();
    
            // Foreign key constraint
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
        });
    }
    
    public function down() {
        Schema::dropIfExists('event_timings');
    }
};
