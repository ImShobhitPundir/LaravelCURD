<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->string('product_name');
            $table->string('trade_name');
            $table->string('finish');
            $table->string('product_code');
            $table->string('sort_description');
            $table->string('description');
            $table->string('weave');
            $table->string('gsm');
            $table->string('max_price');
            $table->string('location');
            $table->string('certificate');
            $table->string('blend');
            $table->string('length');
            $table->string('width');
            $table->string('height');
            $table->string('image');
            $table->integer('user_id');
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
        Schema::dropIfExists('products');
    }
}
