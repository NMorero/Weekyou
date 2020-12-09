<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyLeaderOfDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('LEADERS_OF_DEVELOPERS', function (Blueprint $table) {

            $table->unsignedBigInteger('leader_id');
            $table->foreign('leader_id')->references('id')->on('PROJECT_LEADERS');

            $table->unsignedBigInteger('developer_id');
            $table->foreign('developer_id')->references('id')->on('DEVELOPERS');


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
