<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Experts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('image');
            $table->string('price');
            $table->timestamps();

        });



        Schema::create('Expert_product', function (Blueprint $table) {

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('Experts')->onDelete('cascade');
            $table->integer('Expert_id')->unsigned()->index();
            $table->foreign('Expert_id')->references('id')->on('Experts')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Expert_product');
        Schema::dropIfExists('Experts');

    }
}
