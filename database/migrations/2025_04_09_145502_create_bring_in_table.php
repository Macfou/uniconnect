<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBringInTable extends Migration
{
    public function up()
    {
        Schema::create('bring_in', function (Blueprint $table) {
            $table->id();
            $table->json('equipment');       // array of equipment names
            $table->json('quantity');        // array of quantities
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('listings_id')->constrained()->onDelete('cascade');
            $table->text('rejection_reason')->nullable();
            $table->string('status')->default('pending');
            $table->json('images')->nullable(); // array of filenames or paths
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('bring_in');
    }


};
