<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_commandes', function (Blueprint $table) {
            $table->id();
            $table->integer('qty')->unsigned();

            $table->timestamps();

            $table->unsignedBigInteger('commande_id')->nullable();
            $table->foreign('commande_id')->references('id')->on('commandes')->onUpdate('cascade')->onDelete('set null');

            $table->unsignedBigInteger('consommation_id')->nullable();
            $table->foreign('consommation_id')->references('id')->on('consommations')->onUpdate('cascade')->onDelete('set null');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_commandes');
    }
}
