<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->enum('term', [1, 2]);
            $table->smallInteger('year');
            $table->integer('entered_by')->unsigned()->nullable();
            $table->string('ex_type');
            $table->decimal('marks');
            $table->char('grade', 1);
            $table->timestamps();

            $table->unique(['student_id', 'subject_id', 'term', 'year', 'ex_type']);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('entered_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_results');
    }
}
