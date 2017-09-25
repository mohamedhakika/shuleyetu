<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombinationStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combination_student', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('combination_id')->unsigned();
            $table->unique(['student_id', 'combination_id']);
            $table->timestamps();

            $table->foreign('student_id')->references('id')
                ->on('students')->onDelete('cascade');
            $table->foreign('combination_id')->references('id')
                ->on('combinations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('combination_student');
    }
}
