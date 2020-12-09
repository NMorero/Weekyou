<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyManagersOfLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('MANAGERS_OF_LEADERS', function (Blueprint $table) {

            $table->unsignedBigInteger('manager_id');
            $table->foreign('manager_id')->references('id')->on('PROJECT_MANAGERS');

            $table->unsignedBigInteger('leader_id');
            $table->foreign('leader_id')->references('id')->on('PROJECT_LEADERS');


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
