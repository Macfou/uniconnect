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
    Schema::table('deanapproval', function (Blueprint $table) {
        $table->string('pdf_file')->nullable(); // Store the file path or name
    });
}

public function down()
{
    Schema::table('deanapproval', function (Blueprint $table) {
        $table->dropColumn('pdf_file');
    });
}
};
