<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_shipping', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->string('ship_name');
            $table->string('ship_email');
            $table->string('ship_phone');
            $table->string('ship_address');
            $table->string('ship_deliveryTime');
            $table->string('note');
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
        Schema::dropIfExists('orders_shipping');
    }
}
