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
            $table->string('schedule_impact')->nullable();
            $table->string('budget_impact')->nullable();
            $table->string('delivery_method')->nullable();
            $table->integer('estimated_schedule')->nullable();
            $table->string('contract_value')->nullable();
            $table->string('market_sector')->nullable();
            $table->string('topic')->nullable();
            $table->string('location')->nullable();
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
