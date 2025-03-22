<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('saved_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faculty_id'); // Assuming faculty is stored in users table
            $table->unsignedBigInteger('organization_id');
            $table->string('year_level');
            $table->string('section_name');
            $table->timestamps();

            // Foreign keys
            $table->foreign('faculty_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('saved_sections');
    }
};
