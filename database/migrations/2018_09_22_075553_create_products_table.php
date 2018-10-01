<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('p_id')->unique();
            $table->boolean('status')->default(1);
            $table->integer('user_id');
            $table->string('name');
            $table->bigInteger('sale_price')->nullable();
            $table->bigInteger('regular_price');
            $table->mediumText('short_description')->nullable();
            $table->text('description');
            $table->string('slug')->unique();
            $table->string('sku')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('stock_status');
            $table->float('weight')->nullable();
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->text('purchase_note')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('popular')->default(0);
            $table->boolean('reviews')->default(1);
            $table->softDeletes();
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
