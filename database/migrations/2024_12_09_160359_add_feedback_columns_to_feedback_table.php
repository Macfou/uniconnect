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
        Schema::table('feedback', function (Blueprint $table) {
            $table->text('feedback_venue')->nullable();
            $table->text('feedback_time')->nullable();
            $table->text('feedback_speaker')->nullable();
            $table->integer('sentiment_venue')->nullable();
            $table->integer('sentiment_time')->nullable();
            $table->integer('sentiment_speaker')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->dropColumn([
                'feedback_venue',
                'feedback_time',
                'feedback_speaker',
                'sentiment_venue',
                'sentiment_time',
                'sentiment_speaker'
            ]);
        });
    }
    
};
