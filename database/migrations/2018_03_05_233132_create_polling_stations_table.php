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
            $table->string('received_requests_via_letter')->nullable();
            $table->string('voters_allowed_to_vote_by_letter')->nullable();
            $table->string('voters_not_allowed_to_vote_by_letter')->nullable();
            $table->string('received')->nullable();
            $table->string('unused')->nullable();
            $table->string('used')->nullable();
            $table->string('control_coupons')->nullable();
            $table->string('trim_confirmations')->nullable();
            $table->string('valid')->nullable();
            $table->string('invalid')->nullable();
            $table->string('registered')->nullable();
            $table->string('registered_check');
            $table->string('voted_at_the_polling_station')->nullable();
            $table->string('voted_out_of_the_polling_station')->nullable();
            $table->string('in_total')->nullable();
            $table->string('valid_save')->nullable();
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
