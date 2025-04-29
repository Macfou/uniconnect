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
    Schema::table('bring_in', function (Blueprint $table) {
        $table->date('date_in')->nullable();
        $table->date('date_out')->nullable();
    });
}

public function down()
{
    Schema::table('bring_in', function (Blueprint $table) {
        $table->dropColumn(['date_in', 'date_out']);
    });
}

};
