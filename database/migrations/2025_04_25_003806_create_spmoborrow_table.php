<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpmoborrowTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('spmoborrow', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('listing_id');
            $table->unsignedBigInteger('equipment_id');
            $table->integer('quantity');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable();

            // Optional: Add indexes for foreign keys if needed
            $table->index('listing_id');
            $table->index('equipment_id');
            $table->index('user_id');

            // Optional: Add foreign key constraints if you want relationships
            // $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
            // $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spmoborrow');
    }
}
