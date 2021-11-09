<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieConsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_consos', function (Blueprint $table) {
            $table->id();
            $table->string('categorie_nom');
            $table->integer('categorie_rang');
            $table->timestamps();

            $table->unsignedBigInteger('categorie_etablissement_id');
            $table->foreign('categorie_etablissement_id')->references('id')->on('etablissements');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorie_consos');
    }
}
