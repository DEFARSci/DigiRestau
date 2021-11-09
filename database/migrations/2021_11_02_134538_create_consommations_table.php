<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsommationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consommations', function (Blueprint $table) {
            $table->id();
            $table->string('consommation_titre');
            $table->string('consommation_description');
            $table->string('consommation_statut');
            $table->date('consommation_added_dateTime');

            $table->timestamps();

            $table->unsignedBigInteger('consommation_categorie_id');
            $table->foreign('consommation_categorie_id')->references('id')->on('categorie_consos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consommations');
    }
}
