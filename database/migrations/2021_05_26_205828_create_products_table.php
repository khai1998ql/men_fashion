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
            $table->bigIncrements('id');
            $table->string('product_name')->nullable();
            $table->string('slug_product_name')->nullable();
            $table->string('product_code')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('product_price')->nullable();
            $table->integer('discount_price')->nullable();
            $table->integer('product_status')->default(1);
            $table->integer('product_view')->default(0);
            $table->integer('product_sold')->default(0);
            $table->integer('hot_deal')->default(0)->nullable();
            $table->integer('hot_new')->default(0)->nullable();
            $table->integer('trend')->default(0)->nullable();
            $table->string('product_avatar')->nullable();
            $table->string('product_images_big')->nullable();
            $table->string('product_images_small')->nullable();
            $table->string('product_content')->nullable();
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
