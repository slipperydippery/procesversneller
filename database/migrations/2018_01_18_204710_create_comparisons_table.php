<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComparisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comparisons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comparison_id')->unsigned();
            $table->integer('scan_id')->unsigned();

            $table->foreign('scan_id')->references('id')->on('scans');
            $table->foreign('comparison_id')->references('id')->on('scans');

            // $table->primary(array('id', 'scan_id', 'comparison_id'));
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
        Schema::dropIfExists('comparisons');
    }
}
