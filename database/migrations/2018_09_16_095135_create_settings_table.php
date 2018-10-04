<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->default(1);

            $table->string('site_name');
            $table->text('tagline')->nullable();

            $table->string('email');
            $table->string('author')->nullable();
            $table->text('description')->nullable();

            $table->integer('drole')->default(4);
            $table->boolean('membership')->default(1);

            $table->integer('product_dir');
            $table->integer('post_dir');

            $table->boolean('copyright')->default(0);
            $table->text('copyright_text');
            $table->boolean('privacy')->default(0);
            $table->boolean('legal')->default(0);
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
        Schema::dropIfExists('settings');
    }
}
