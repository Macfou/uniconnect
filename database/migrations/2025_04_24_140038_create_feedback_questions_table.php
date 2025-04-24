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
        Schema::create('feedback_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listings_id');
            $table->unsignedBigInteger('users_id');
    
            $table->string('q_one')->default('Overall quality of the event');
            $table->string('q_two')->default('Engagement of the event from start to finish');
            $table->string('q_three')->default('Satisfaction with the events organization');
            $table->string('q_four')->default('Relevance of the event content to your interests');
            $table->string('q_five')->default('Likelihood of attending a similar event in the future');
    
            $table->string('q_six')->default('Comfort of the seating and space');
            $table->string('q_seven')->default('Accessibility of the venue location');
            $table->string('q_eight')->default('Suitability of the venue for the event');
            $table->string('q_nine')->default('Cleanliness and maintenance of the venue');
            $table->string('q_ten')->default('Audio/Visual setup of the venue');
    
            $table->string('q_eleven')->default('Clarity and understandability of presenters');
            $table->string('q_twelve')->default('Effectiveness of visual aids (slides, videos)');
            $table->string('q_thirteen')->default('Organization of the presentations');
            $table->string('q_fourteen')->default('Speaker knowledge and expertise');
            $table->string('q_fifteen')->default('Engagement and interactivity of the presentations');
    
            $table->string('q_sixteen')->default('Timeliness of event start and end');
            $table->string('q_seventeen')->default('Pacing of each session or activity');
            $table->string('q_eighteen')->default('Reasonableness of break durations');
            $table->string('q_nineteen')->default('Efficiency of time allocation per speaker/topic');
            $table->string('q_twenty')->default('Management of the overall event schedule');
    
            $table->timestamps();
    
            $table->foreign('listings_id')->references('id')->on('listings')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_questions');
    }
};
