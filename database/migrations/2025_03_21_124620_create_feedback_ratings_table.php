<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('feedback_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedback_id')->constrained()->onDelete('cascade');
            $table->foreignId('listing_id')->constrained('listings')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('category'); // Venue, Time Management, etc.
            $table->integer('question_number'); // 1-5 per category
            $table->integer('rating'); // 1-5
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('feedback_ratings');
    }
};

