<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsettings', function (Blueprint $table) {
            $table->increments('id');

            // Default article settings
            $table->boolean('discussion')->default(1);

            // Other comment settings
            $table->boolean('discussion_full')->default(1);
            $table->boolean('discussion_auth')->default(1);
            $table->boolean('auto_close_discussion')->default(1);

            // Email me whenever
            $table->boolean('discussion_email')->default(0);
            $table->boolean('discussion_spam_email')->default(0);

            // Before a comment appears
            $table->boolean('discussion_approve')->default(1);
            $table->boolean('discussion_approve_once')->default(0);

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
        Schema::dropIfExists('dsettings');
    }
}
