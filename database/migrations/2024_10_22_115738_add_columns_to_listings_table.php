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
        Schema::table('listings', function (Blueprint $table) {
            $table->string('event_link')->nullable(); // Add event_link column
            $table->time('time_start')->nullable(); // Add time_start column
            $table->time('time_end')->nullable(); // Add time_end column
            $table->integer('attendee')->nullable(); // Add attendee column
           
        });
    }

    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn(['event_link', 'time_start', 'time_end', 'attendee']); // Rollback columns
        });
    }
};
