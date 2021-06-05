<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_detail', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('product_id')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();
            $table->integer('product_qty')->nullable();
            $table->string('slug_product_color')->nullable();
            $table->integer('product_detail_sold')->default(0)->nullable();
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
        Schema::dropIfExists('product_detail');
    }
}
