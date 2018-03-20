<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollingStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polling_stations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();

            $table->string('name');
            $table->string('received_requests_via_letter');
            $table->string('voters_allowed_to_vote_by_letter');
            $table->string('voters_not_allowed_to_vote_by_letter');
            $table->string('received');
            $table->string('unused');
            $table->string('used');
            $table->string('control_coupons');
            $table->string('trim_confirmations');
            $table->string('valid');
            $table->string('invalid');
            $table->string('registered');
            $table->string('registered_check');
            $table->string('voted_at_the_polling_station');
            $table->string('voted_out_of_the_polling_station');
            $table->string('in_total');
            $table->string('valid_save');
            $table->timestamps();

            $table->foreign('municipality_id')
                ->references('id')->on('municipalities')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polling_stations');
    }
}
