<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggedCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagged_case', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('case_id')->unsigned()->index();
            $table->integer('keyword_id')->unsigned()->index();
            $table->integer('outcome_id')->unsigned()->index();
            $table->integer('class_id')->unsigned()->index();


            // Foreign key constraints -- nullable because some cases might have more of one content type than another.
            // Ex. a case could have 3 outcomes but only 1 keyword. This would require 3 rows, 2 with null keywords. Case
            // cannot be nullable because a row cannot exist without a case.
            $table->foreign('case_id')->references('id')->on('cases');
            $table->foreign('keyword_id')->references('id')->on('keywords')->nullable();
            $table->foreign('outcome_id')->references('id')->on('outcomes')->nullable();
            $table->foreign('class_id')->references('id')->on('classes')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tagged_case');
    }
}
