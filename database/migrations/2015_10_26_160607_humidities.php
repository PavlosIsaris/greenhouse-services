<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Humidities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // humidities table
        Schema::create('humidities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('slave_name');
            $table->integer('humidity');
            $table->timestamp('added_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // drop humidities table
        Schema::drop('humidities');
    }
}
