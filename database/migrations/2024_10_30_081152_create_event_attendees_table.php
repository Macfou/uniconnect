<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('event_attendees', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('event_id')->constrained('listings')->onDelete('cascade'); // Foreign key referencing listings
            $table->foreignId('attendee_id')->constrained('users')->onDelete('cascade'); // Foreign key referencing users
            $table->timestamp('registered_at')->useCurrent(); // Timestamp for registration
            $table->timestamps(); // Laravel default created_at and updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_attendees');
    }
};
