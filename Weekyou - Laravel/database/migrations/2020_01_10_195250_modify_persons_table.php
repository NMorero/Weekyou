<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('PERSONS', function (Blueprint $table) {

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('COUNTRIES');

            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('STATES');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('CITIES');

            $table->unsignedBigInteger('relationship_id')->nullable();
            $table->foreign('relationship_id')->references('id')->on('RELATIONSHIP');
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
