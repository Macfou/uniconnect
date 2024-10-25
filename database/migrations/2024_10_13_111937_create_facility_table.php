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
    Schema::create('facility', function (Blueprint $table) {
        $table->id(); // This will create an auto-incrementing primary key
        $table->string('facilityName'); // Column for facility name
        $table->string('facilityImage'); // Column for facility image
        $table->integer('facilityCapacity'); // Column for facility capacity
        $table->timestamps(); // Columns for created_at and updated_at timestamps
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility');
    }
};
