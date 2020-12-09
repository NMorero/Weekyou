<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TASKS', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('USERS');

            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('PROJECTS');

            $table->unsignedBigInteger('view_id')->nullable();
            $table->foreign('view_id')->references('id')->on('VIEWS');

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('CLIENTS');


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
