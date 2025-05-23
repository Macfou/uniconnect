<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeSomeListingsColumnsNullable extends Migration
{
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->string('tags')->nullable()->change();
            $table->string('organization')->nullable()->change();
            $table->string('venue')->nullable()->change();
            $table->longText('description')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->string('title')->nullable(false)->change();
            $table->string('tags')->nullable(false)->change();
            $table->string('organization')->nullable(false)->change();
            $table->string('venue')->nullable(false)->change();
            $table->longText('description')->nullable(false)->change();
        });
    }
}
