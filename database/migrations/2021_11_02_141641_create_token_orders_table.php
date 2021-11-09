<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokenOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_orders', function (Blueprint $table) {
            $table->id();
            $table->string('token_order_token');
            $table->string('token_order_table');
            $table->integer('token_order_duration');
            $table->date('token_order_added_dateTime');

            $table->timestamps();

            $table->unsignedBigInteger('token_order_etablissement_id');
            $table->foreign('token_order_etablissement_id')->references('id')->on('etablissements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token_orders');
    }
}
