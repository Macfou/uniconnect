<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTimeAndDateColumnsInEventAdminTable extends Migration
{
    public function up()
    {
        Schema::table('event_admin', function (Blueprint $table) {
            $table->renameColumn('time', 'event_time');
            $table->renameColumn('date', 'event_date');
        });
    }

    public function down()
    {
        Schema::table('event_admin', function (Blueprint $table) {
            $table->renameColumn('event_time', 'time');
            $table->renameColumn('event_date', 'date');
        });
    }
}

