<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('PROJECTS', function (Blueprint $table) {

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('CLIENTS');

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
