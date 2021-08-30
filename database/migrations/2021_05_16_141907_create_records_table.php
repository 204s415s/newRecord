<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('student_id')->unsigned();
            $table->dateTime('next', 0)->nullable();
            // $table->date('nextdate');
            // $table->time('nexttime');
            $table->string('style', 10);
            $table->timestamps();
            $table->dateTime('deleted_at', 0)->nullable();
            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
