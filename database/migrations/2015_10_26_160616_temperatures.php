<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Temperatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // temperatures table
        Schema::create('temperatures', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('slave_name');
            $table->integer('temperature');
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
        Schema::drop('temperatures');
    }
}
