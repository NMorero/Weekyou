<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('FEEDBACKS', function (Blueprint $table) {

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('CLIENTS');

            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('PROJECTS');

            $table->unsignedBigInteger('view_id')->nullable();
            $table->foreign('view_id')->references('id')->on('VIEWS');

            $table->unsignedBigInteger('developer_id')->nullable();
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
