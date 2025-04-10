<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitTransferTable extends Migration
{
    public function up()
    {
        Schema::create('permit_transfer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('listings_id');
            $table->json('equipment'); // for storing multiple equipment names
            $table->json('quantity');  // for storing multiple quantities
            $table->text('reject_reason')->nullable();
            $table->string('from'); // location or department string
            $table->string('to');   // location or department string
            $table->unsignedBigInteger('gso_id');
            $table->timestamps();

            // Foreign keys (optional depending on relationships)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('listings_id')->references('id')->on('listings')->onDelete('cascade');
            $table->foreign('gso_id')->references('id')->on('gso')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('permit_transfer');
    }


};
