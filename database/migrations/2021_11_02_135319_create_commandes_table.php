<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->float('commande_prix');
            $table->string('commande_statut');
            $table->string('commande_table');
            $table->string('commande_livraison');
            $table->date('commande_added_dateTime');
            $table->date('commande_startcook_dateTime');
            $table->date('commande_endcook_dateTime');
            $table->date('commande_done_dateTime');

            $table->timestamps();

            $table->unsignedBigInteger('commande_user_id');
            $table->foreign('commande_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
