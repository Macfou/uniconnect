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
        Schema::table('event_attendees', function (Blueprint $table) {
            $table->unsignedBigInteger('attendee_id')->nullable()->after('id');
    
            // Add foreign key constraint
            $table->foreign('attendee_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('event_attendees', function (Blueprint $table) {
            $table->dropForeign(['attendee_id']);
            $table->dropColumn('attendee_id');
        });
    }
    
};
