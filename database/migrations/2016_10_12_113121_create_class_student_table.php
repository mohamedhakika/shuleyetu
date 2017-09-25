<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_student', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->smallInteger ('year');
            $table->unique(['student_id', 'year']);
            $table->timestamps();

            $table->foreign('student_id')->references('id')
                ->on('students')->onDelete('cascade');
            $table->foreign('class_id')->references('id')
                ->on('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('class_student');
    }
}
