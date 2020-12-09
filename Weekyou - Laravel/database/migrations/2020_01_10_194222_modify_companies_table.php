<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('COMPANIES', function (Blueprint $table) {

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('COUNTRIES');

            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('STATES');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('CITIES');

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
