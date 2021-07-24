<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('student_id')->unsigned();
            $table->string('progress', 100);
            $table->string('topical', 50)->nullable();
            $table->string('question', 200)->nullable();
            $table->string('aim', 50);
            $table->dateTime('next', 0)->nullable();
            // $table->date('nextdate');
            // $table->time('nexttime');
            $table->string('style', 10);
            $table->timestamps();
            $table->dateTime('deleted_at', 0)->nullable();
            
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
