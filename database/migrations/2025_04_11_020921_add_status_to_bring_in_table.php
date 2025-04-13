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
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
        });
    }
    
    public function down()
    {
        Schema::table('bring_in', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
    
    
};
