<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeAdataProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_adata_product', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('attribute_id');
            $table->integer('adata_id');
            $table->primary(['product_id', 'attribute_id', 'adata_id']);
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
        Schema::dropIfExists('attribute_adata_product');
    }
}
