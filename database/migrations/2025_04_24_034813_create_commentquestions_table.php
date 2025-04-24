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
        Schema::create('commentquestions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('listings_id');
            
            $table->string('overall')->default('What do you think about the event?');
            $table->string('venue')->default('What can you say about the venue?');
            $table->string('time')->default('What can you say about the event Time Management?');
            $table->string('speaker1')->default('What can you say about the Presentation?');
            $table->string('speaker2')->nullable()->default('What can you say about the Presentation?');
            $table->string('speaker3')->nullable()->default('What can you say about the Presentation?');
            $table->string('speaker4')->nullable()->default('What can you say about the Presentation?');
            $table->string('speaker5')->nullable()->default('What can you say about the Presentation?');
    
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentquestions');
    }
};
