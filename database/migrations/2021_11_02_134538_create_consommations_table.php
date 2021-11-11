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
            $table->string('consommation_image')->nullable();
            $table->double('consommation_prix');
            $table->boolean('statut')->default(0);

            $table->timestamps();

            $table->unsignedBigInteger('consommation_categorie_id');
            $table->foreign('consommation_categorie_id')->references('id')->on('categorie_consos')->onDelete('cascade');

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
        Schema::dropIfExists('consommations');
    }
}
