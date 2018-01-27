<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeGroupPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_group', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('employee_id')->unsigned()->index()->nullable();
            //$table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
            $table->integer('group_id')->unsigned()->index()->nullable();
            //$table->foreign('group_id')->references('id')->on('group')->onDelete('cascade');
            $table->primary(['employee_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employee_group');
    }

}
