<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Methane extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // temperatures table
        Schema::create('methane', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('methane_value');
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
        Schema::drop('methane');
    }
}
