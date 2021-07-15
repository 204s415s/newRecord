<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curricula', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('student_id')->unsigned();
            $table->string('progress', 10);
            $table->string('question', 200)->nullable();
            $table->string('aim', 10);
            $table->date('nextdate');
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
        Schema::dropIfExists('curricula');
    }
}
