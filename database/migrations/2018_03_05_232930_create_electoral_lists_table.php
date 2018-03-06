<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectoralListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electoral_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('election_id')->unsigned();

            $table->integer('number');
            $table->string('name');
            $table->timestamps();

            $table->foreign('election_id')
                ->references('id')->on('elections')
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
        Schema::dropIfExists('electoral_lists');
    }
}
