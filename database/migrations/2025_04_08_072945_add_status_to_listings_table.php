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
            $table->enum('status', ['Pending', 'Approve', 'Reject'])->default('Pending')->after('id');
        });
    }
    
    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
    
};
