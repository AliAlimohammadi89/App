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
            $table->unsignedInteger('Customer_id')->comment('Relation to Customer Table');

            $table->foreign('Customer_id')->references('id')->on('Customers');


//            $table->foreign('Customer_id')
//                ->references('id')->on('Customers');

            $table->integer('Expert_id')->unsigned()->nullable()->comment('Relation To Expert Table');
            $table->foreign('Expert_id')
                ->references('id')->on('Experts');

            $table->integer('product_id')->unsigned()->nullable()->comment('Relation to Product Table');
            $table->foreign('product_id')
                ->references('id')->on('products');


            $table->string('title')->comment('Order Title');

            $table->string('description')->comment('More Order Information');
            $table->string('image')->comment('Image For problem Or simple Service');
            $table->string('price')->comment('Final agreed price');
            $table->integer('status')->comment('0 => Just Request from Customer , 1 => Accept form Expert but not to do, 2 => down from Expert  ');
            $table->timestamp('serviceTime')->comment('Suggested time to get services');
            $table->timestamps();
            $table->text('SpecialtyFields')->nullable()->comment('SpecialtyFields Form Product Table (Title=>Value)');


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
