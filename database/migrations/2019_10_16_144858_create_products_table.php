<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Stmt\Expression;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
//            $table->charset = 'utf8mb4_unicode_ci';
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('image');
            $table->integer('Special');

//            $table->string('price');
            $table->timestamps();


            $table->text('SpecialtyFields')->nullable();




        });
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('image');
            $table->timestamps();
        });


        Schema::create('category_product', function (Blueprint $table) {

            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');


        });

        Schema::create('Experts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->decimal('wallet', 8, 2)->nullable();
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


        Schema::create('Expert_product', function (Blueprint $table) {

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('Expert_id')->unsigned()->index();
            $table->foreign('Expert_id')->references('id')->on('Experts')->onDelete('cascade');


        });





//        Schema::create('Customer_Suggestion', function (Blueprint $table) {
//
//

//
//            $table->integer('Suggestion_id')->unsigned()->index();
//            $table->foreign('Suggestion_id')->references('id')->on('Suggestions')->onDelete('cascade');
//            $table->integer('Customer_id')->unsigned()->index();
//            $table->foreign('Customer_id')->references('id')->on('Customers')->onDelete('cascade');
//
//
//        });




    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('Expert_product');
        Schema::dropIfExists('Experts');

    }
}
