<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('COMPANIES', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cuit');
            $table->string('alias');
            $table->string('website');
            $table->string('administrator_name');
            $table->string('administrator_email');
            $table->string('production_manager_name');
            $table->string('production_email');
            $table->string('phone_number');
            $table->string('address');
            $table->integer('postal_code');
            $table->integer('identification_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('COMPANIES');
    }
}
