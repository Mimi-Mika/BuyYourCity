<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            //define colunms
            $table->increments('id');
            $table->string('name')->unique();
            $table->double('latitude', 20, 10);
            $table->double('longitude', 20, 10);
            $table->integer('pointsGiven');
            $table->integer('pointsCost');
            $table->string('pictPath');
            //define foreign key on user id
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('places');
    }
}
