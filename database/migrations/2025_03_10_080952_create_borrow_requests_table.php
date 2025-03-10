<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('borrow_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained('listings')->onDelete('cascade');
            $table->unsignedBigInteger('equipment_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->string('status')->default('pending');
            // Fix: Correct the table name to "gsocategory"
            $table->foreign('equipment_id')->references('id')->on('gsocategory')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrow_requests');
    }
};
