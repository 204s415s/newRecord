<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_records', function (Blueprint $table) {
            $table->integer('project_id')->unsigned();
            $table->integer('record_id')->unsigned();
            $table->timestamps();
            $table->dateTime('deleted_at', 0)->nullable();
            
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('project_records');
    }
}
