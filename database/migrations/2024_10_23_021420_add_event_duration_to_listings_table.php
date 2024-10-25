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
        $table->integer('event_duration')->nullable(); // Adding the event_duration column
    });
}

public function down()
{
    Schema::table('listings', function (Blueprint $table) {
        $table->dropColumn('event_duration'); // Rolling back the event_duration column
    });
}
};
