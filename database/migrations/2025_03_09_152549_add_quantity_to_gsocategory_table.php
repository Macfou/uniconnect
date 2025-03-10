<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('gsocategory', function (Blueprint $table) {
            $table->integer('quantity')->default(0)->after('name'); // Replace 'column_name' with the actual column after which you want to place 'quantity'
        });
    }

    public function down()
    {
        Schema::table('gsocategory', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
