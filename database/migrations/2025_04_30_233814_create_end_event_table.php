<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndEventTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('end_event', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listings_id');
            $table->unsignedBigInteger('users_id');
            $table->boolean('end_event')->default(0);
            $table->timestamps();

            // Optional: Add foreign keys if you want
            // $table->foreign('listings_id')->references('id')->on('listings')->onDelete('cascade');
            // $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('end_event');
    }
}
