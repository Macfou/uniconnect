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
        Schema::create('ufmo', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('fname'); // First name
            $table->string('lname'); // Last name
            $table->string('email')->unique(); // Email (unique)
            $table->string('password'); // Password (hashed)
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ufmo');
    }
};
