<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScandatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scandates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->string('date_readable');
            $table->integer('scan_id')->unsigned()->nullable();
            $table->foreign('scan_id')->references('id')->on('scans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scandates');
    }
}
