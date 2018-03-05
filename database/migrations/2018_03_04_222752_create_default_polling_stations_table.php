<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultPollingStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_polling_stations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('default_municipality_id')->unsigned();
            $table->string('name');
            $table->integer('registered');
            $table->timestamps();
            $table->foreign('default_municipality_id')
                ->references('id')->on('default_municipalities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('default_polling_stations');
    }
}
