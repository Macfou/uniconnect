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
            $table->string('event_time')->change(); // Change event_time to string
        });
    }
    
    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->time('event_time')->change(); // Revert back to TIME if needed
        });
    }
    
};
