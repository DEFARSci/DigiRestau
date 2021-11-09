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
            $table->integer('option_commande_nbre');
            $table->string('option_commande_titre_consommation');

            $table->timestamps();

            $table->unsignedBigInteger('option_commande_consommation_id');
            $table->foreign('option_commande_consommation_id')->references('id')->on('option_consommations');

            $table->unsignedBigInteger('option_commande_commande_id');
            $table->foreign('option_commande_commande_id')->references('id')->on('commandes');
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
