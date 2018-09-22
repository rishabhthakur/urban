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
            $table->string('name');
            $table->bigInteger('sale_price')->nullable();
            $table->bigInteger('regular_price');
            $table->mediumText('short_description')->nullable();
            $table->text('description');
            $table->string('slug');
            $table->integer('brand_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('stock_status');
            $table->float('weight')->nullable();
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('popular')->default(0);
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