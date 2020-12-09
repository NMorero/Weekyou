<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyDevelopersOfProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('DEVELOPERS_OF_PROJECTS', function (Blueprint $table) {

            $table->unsignedBigInteger('developer_id');
            $table->foreign('developer_id')->references('id')->on('DEVELOPERS');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('PROJECTS');

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
