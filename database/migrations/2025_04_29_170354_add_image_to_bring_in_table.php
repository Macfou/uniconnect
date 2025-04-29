<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToBringInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bring_in', function (Blueprint $table) {
            $table->string('image')->nullable(); // Adds an image column (nullable)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bring_in', function (Blueprint $table) {
            $table->dropColumn('image'); // Drop the image column if rollback
        });
    }
}
