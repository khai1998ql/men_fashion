<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_detail', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('order_id');
            $table->integer('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('singleprice')->nullable();
            $table->integer('singlesale')->nullable();
            $table->integer('totalprice')->nullable();
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
        Schema::dropIfExists('orders_detail');
    }
}
