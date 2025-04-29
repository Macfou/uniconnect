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
        Schema::table('event_admin', function (Blueprint $table) {
            $table->string('time')->after('date'); // Replace 'your_column' with the existing column after which you want to add 'time'
        });
    }
    
    public function down()
    {
        Schema::table('event_admin', function (Blueprint $table) {
            $table->dropColumn('time');
        });
    }
    
};
