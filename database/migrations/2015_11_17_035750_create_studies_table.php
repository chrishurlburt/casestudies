<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title', 150);
            $table->text('problem');
            $table->text('solution');
            $table->text('analysis');
            $table->text('excerpt');
            $table->string('slug');
            $table->boolean('draft');
            $table->integer('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('studies');
    }
}
