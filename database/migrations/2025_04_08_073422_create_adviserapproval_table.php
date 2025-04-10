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
        Schema::create('adviserapproval', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('adviser_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('listings_id');
            $table->enum('status', ['Pending', 'Approve', 'Reject'])->default('Pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
    
            // Foreign keys (optional but recommended)
            $table->foreign('adviser_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('listings_id')->references('id')->on('listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adviserapproval');
    }
};
