<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('miname')->nullable();
            $table->string('org')->nullable();
            $table->string('status')->nullable();
            $table->string('yearlevel')->nullable();
            $table->string('section')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['fname', 'lname', 'miname', 'org', 'status', 'yearlevel', 'section']);
        });
    }
};
