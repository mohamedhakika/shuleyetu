<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('vidato_id')->unsigned();
            $table->string('name');
            $table->enum('level',[0,1])->default('0');
            $table->char('stream', 1);
			$table->smallInteger('year');
            $table->unique(['name', 'stream', 'year']);
            $table->timestamps();
            $table->foreign('vidato_id')->references('id')->on('vidato')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('classes');
    }
}
