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
        Schema::create('todayEvent', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tags');
            $table->string('image');
            $table->string('organization');
            $table->string('venue');
            $table->text('description');
            $table->string('qrcode');
            $table->string('event_link')->nullable();  // Nullable column
            $table->time('timestart');
            $table->time('timeend');
            $table->integer('attendee');
            $table->integer('available_sits');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todayEvent');
    }
};
