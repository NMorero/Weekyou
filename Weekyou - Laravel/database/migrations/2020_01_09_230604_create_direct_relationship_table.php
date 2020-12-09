<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DIRECT_RELATIONSHIP', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_labor_relationship');
            $table->string('social_work');
            $table->string('labor_union');
            $table->string('labor_agreement');
            $table->string('iva_condition');
            $table->string('account_bank');
            $table->string('account_number');
            $table->string('cbu_number');
            $table->string('familyContact_name');
            $table->string('familyContact_phoneNumber');
            $table->string('familyContact_address');
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
        Schema::dropIfExists('DIRECT_RELATIONSHIP');
    }
}
