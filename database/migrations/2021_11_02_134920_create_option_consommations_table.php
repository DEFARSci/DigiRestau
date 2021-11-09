<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionConsommationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_consommations', function (Blueprint $table) {
            $table->id();
            $table->float('option_conso_prix');
            $table->string('option_conso_titre');

            $table->timestamps();

            $table->unsignedBigInteger('consommation_id');
            $table->foreign('consommation_id')->references('id')->on('consommations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_consommations');
    }
}
