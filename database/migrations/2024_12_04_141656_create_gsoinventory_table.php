<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGsoInventoriesTable extends Migration
{
    public function up()
    {
        Schema::create('gsoinventory', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Supply name
            $table->integer('quantity')->default(0); // Quantity of the supply
            $table->string('status')->default('Available'); // Status of the supply
            $table->foreignId('gsocategory_id')->constrained()->onDelete('cascade'); // Foreign key to 'gso_categories' table
            $table->timestamps(); // Timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('gsoinventory');
    }
}
