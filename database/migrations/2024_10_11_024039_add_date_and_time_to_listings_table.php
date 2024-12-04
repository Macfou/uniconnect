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
             $table->date('event_date')->nullable();  // For the date field
             $table->string('event_time')->change();  // For the time field
         });
     }
     
     public function down()
     {
         Schema::table('listings', function (Blueprint $table) {
             $table->dropColumn(['event_date', 'event_time']);
         });
     }
     
};
