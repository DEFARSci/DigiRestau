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
            $table->integer('quantite');

            $table->timestamps();

            $table->unsignedBigInteger('option_commande_consommation_id');
            $table->foreign('option_commande_consommation_id')->references('id')->on('consommations')->onDelete('cascade');

            $table->unsignedBigInteger('option_commande_commande_id');
            $table->foreign('option_commande_commande_id')->references('id')->on('commandes')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
