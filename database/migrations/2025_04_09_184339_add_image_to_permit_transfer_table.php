<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('permit_transfer', function (Blueprint $table) {
            $table->string('image')->nullable()->after('gso_id'); // You can change position with `after()`
        });
    }

    public function down(): void
    {
        Schema::table('permit_transfer', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
