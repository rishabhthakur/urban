<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('set null');
            $table->string('order_no');
            $table->string('bill_email');
            $table->string('bill_name');
            $table->string('bill_phone');
            $table->string('bill_address1');
            $table->string('bill_address2')->nullable();
            $table->string('bill_town_city');
            $table->string('bill_province_state');
            $table->string('bill_country');
            $table->string('bill_postcode');
            $table->string('bill_name_on_card');
            $table->string('bill_subtotal');
            $table->string('bill_tax');
            $table->string('bill_total');
            $table->string('payment_method')->default('stripe');
            $table->boolean('shipped')->default(0);
            $table->string('error')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
