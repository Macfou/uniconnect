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
        Schema::table('spmoborrow', function (Blueprint $table) {
            $table->date('date_of_transfer')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->date('date_of_return')->nullable();
            $table->string('remarks')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('spmoborrow', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_transfer',
                'from',
                'to',
                'date_of_return',
                'remarks',
            ]);
        });
    }
    
};
