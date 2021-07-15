<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            //カラムの要素
            $table->increments('id')->unique();
            $table->string('student_name', 50);
            $table->date('enter');
            $table->string('grade');
            $table->string('experience', 10);
            $table->string('description', 200)->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->dateTime('deleted_at', 0)->nullable();
            
            //外部キー設定
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
