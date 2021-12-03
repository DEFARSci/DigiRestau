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
            $table->enum('statut', ['livre', 'annulle','encours'])->default('encours');
            $table->string('Type_livraison');
            $table->string('numero_table')->nullable();
            $table->text('carts');
            $table->date('commande_added_dateTime');
            $table->timestamps();

            $table->unsignedBigInteger('enseigne_id');
            $table->foreign('enseigne_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('commande_user_id');
            $table->foreign('commande_user_id')->references('id')->on('users')->onDelete('cascade');
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
