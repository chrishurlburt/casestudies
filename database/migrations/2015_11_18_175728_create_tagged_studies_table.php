<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggedStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagged_studies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('study_id')->unsigned()->index();
            $table->integer('keyword_id')->unsigned()->index();
            $table->integer('outcome_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();


            // Foreign key constraints -- nullable because some studies might have more of one content type than another.
            // Ex. a study could have 3 outcomes but only 1 keyword. This would require 3 rows, 2 with null keywords. study
            // cannot be nullable because a row cannot exist without a study.
            $table->foreign('study_id')->references('id')->on('studies');
            $table->foreign('keyword_id')->references('id')->on('keywords')->nullable();
            $table->foreign('outcome_id')->references('id')->on('outcomes')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tagged_studies');
    }
}
