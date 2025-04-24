<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listings_id');
            $table->unsignedBigInteger('users_id');

            // Optional: Store question texts (in case you want dynamic labels later)
            $table->string('q_one')->nullable();
            $table->string('q_two')->nullable();
            $table->string('q_three')->nullable();
            $table->string('q_four')->nullable();
            $table->string('q_five')->nullable();
            $table->string('q_six')->nullable();
            $table->string('q_seven')->nullable();
            $table->string('q_eight')->nullable();
            $table->string('q_nine')->nullable();
            $table->string('q_ten')->nullable();
            $table->string('q_eleven')->nullable();
            $table->string('q_twelve')->nullable();
            $table->string('q_thirteen')->nullable();
            $table->string('q_fourteen')->nullable();
            $table->string('q_fifteen')->nullable();
            $table->string('q_sixteen')->nullable();
            $table->string('q_seventeen')->nullable();
            $table->string('q_eighteen')->nullable();
            $table->string('q_nineteen')->nullable();
            $table->string('q_twenty')->nullable();

            // Ratings 1 to 20
            $table->unsignedTinyInteger('r_one')->nullable();
            $table->unsignedTinyInteger('r_two')->nullable();
            $table->unsignedTinyInteger('r_three')->nullable();
            $table->unsignedTinyInteger('r_four')->nullable();
            $table->unsignedTinyInteger('r_five')->nullable();
            $table->unsignedTinyInteger('r_six')->nullable();
            $table->unsignedTinyInteger('r_seven')->nullable();
            $table->unsignedTinyInteger('r_eight')->nullable();
            $table->unsignedTinyInteger('r_nine')->nullable();
            $table->unsignedTinyInteger('r_ten')->nullable();
            $table->unsignedTinyInteger('r_eleven')->nullable();
            $table->unsignedTinyInteger('r_twelve')->nullable();
            $table->unsignedTinyInteger('r_thirteen')->nullable();
            $table->unsignedTinyInteger('r_fourteen')->nullable();
            $table->unsignedTinyInteger('r_fifteen')->nullable();
            $table->unsignedTinyInteger('r_sixteen')->nullable();
            $table->unsignedTinyInteger('r_seventeen')->nullable();
            $table->unsignedTinyInteger('r_eighteen')->nullable();
            $table->unsignedTinyInteger('r_nineteen')->nullable();
            $table->unsignedTinyInteger('r_twenty')->nullable();

            $table->timestamps();

            $table->foreign('listings_id')->references('id')->on('listings')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
