<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRelatioshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('RELATIONSHIP', function (Blueprint $table) {
            $table->unsignedBigInteger('freelance_id')->nullable();
            $table->foreign('freelance_id')->references('id')->on('FREELANCE_RELATIONSHIP');

            $table->unsignedBigInteger('direct_id')->nullable();
            $table->foreign('direct_id')->references('id')->on('DIRECT_RELATIONSHIP');

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('COMPANIES');

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
