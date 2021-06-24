<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_records', function (Blueprint $table) {
            $table->integer('curriculum_id')->unsigned();
            $table->integer('record_id')->unsigned();
            $table->timestamps();
            $table->dateTime('deleted_at', 0)->nullable();
            
            $table->foreign('curriculum_id')->references('id')->on('curricula');
            $table->foreign('record_id')->references('id')->on('records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculum_records');
    }
}
