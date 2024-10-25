<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();  // Primary key (auto-increment)
            $table->string('orgNameAbbv', 50);  // Organization Abbreviation (e.g. CCIS)
            $table->string('orgName');  // Full Organization Name (e.g. College of Computing and Information Science)
            $table->string('orgLogo')->nullable();  // Path for organization logo, nullable in case it's optional
            $table->timestamps();  // This will automatically add 'created_at' and 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
