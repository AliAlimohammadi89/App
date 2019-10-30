<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->string('Address')->nullable();
            $table->string('Lat')->nullable();
            $table->string('Long')->nullable();
            $table->string('Phone_Number')->index()->unique();
            $table->string('Pass')->nullable();
            $table->string('Email')->nullable();
             $table->string('image')->nullable();
            $table->timestamps();
            $table->rememberToken();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
             Schema::dropIfExists('Customers');

    }
}
