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
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('organization')->nullable();
            $table->date('date')->nullable();
            $table->string('venue')->nullable();
            $table->string('signatory_one')->nullable();
            $table->string('signatory_two')->nullable();
            $table->string('left_logo')->nullable();
            $table->string('right_logo')->nullable();
            $table->unsignedBigInteger('org_creator')->nullable();
    
            // If org_creator references the users table
            $table->foreign('org_creator')->references('id')->on('users')->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('certificates', function (Blueprint $table) {
        $table->dropColumn(['organization', 'date', 'venue', 'signatory_one', 'signatory_two', 'left_logo', 'right_logo', 'org_creator']);
    });
}

};
