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
        Schema::table('officers', function (Blueprint $table) {
            $table->integer('yearlevel')->after('email'); // Add the column after 'email'
        });
    }
    
    public function down()
    {
        Schema::table('officers', function (Blueprint $table) {
            $table->dropColumn('yearlevel'); // To rollback the column addition
        });
    }
};
