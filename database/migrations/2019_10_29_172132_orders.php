<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Customer_id')->unsigned();
            $table->foreign('Customer_id')
                ->references('id')->on('Customers');

            $table->integer('Expert_id')->unsigned()->nullable();
            $table->foreign('Expert_id')
                ->references('id')->on('Experts');

        $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')
                ->references('id')->on('products');


            $table->string('title')->comment('order title for create table test')	;

            $table->string('description');
            $table->string('image');
            $table->string('price');
            $table->timestamps();
            $table->jsonb('SpecialtyFields')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Orders');

    }
}
