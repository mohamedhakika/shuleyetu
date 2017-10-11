<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->integer('year');
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
            
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->unique(['teacher_id', 'subject_id', 'class_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_subjects');
    }
}
