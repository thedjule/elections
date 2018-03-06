<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectoralListPollingStation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electoral_list_polling_station', function (Blueprint $table) {
            $table->integer('electoral_list_id')->unsigned();
            $table->foreign('electoral_list_id')
                ->references('id')->on('electoral_lists')
                ->onDelete('cascade');

            $table->integer('polling_station_id')->unsigned();
            $table->foreign('polling_station_id')
                ->references('id')->on('polling_stations')
                ->onDelete('cascade');

            $table->integer('votes');
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
        Schema::dropIfExists('electoral_list_polling_station');
    }
}
