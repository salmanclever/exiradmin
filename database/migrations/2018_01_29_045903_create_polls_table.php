<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->text('question');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('show_results')->default('0');
            $table->integer('ip_restricted')->default('0');
            $table->integer('status')->default('0');
            $table->integer('votes')->default('0');
            $table->integer('vote_type')->default('0');
            $table->integer('theme_id')->default('0');
            $table->integer('user_restricted')->default('0');
            $table->integer('public')->default('0');
            $table->integer('cookie_restricted')->default('0');
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
        Schema::drop('polls');
    }
}
