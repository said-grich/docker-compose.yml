<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom',100);
            $table->float('pas');
            $table->integer('code_comptable');
            $table->integer('code_analytique');

            //$table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('sous_categorie_id');
            $table->unsignedBigInteger('famille_id');
            $table->unsignedBigInteger('mode_vente_id');
            $table->unsignedBigInteger('unite_id');
            //$table->unsignedBigInteger('preparation_type_id');


            //$table->foreign('categorie_id')->references('id')->on('categories');
            $table->foreign('sous_categorie_id')->references('id')->on('sous_categories');
            $table->foreign('famille_id')->references('id')->on('familles');
            $table->foreign('mode_vente_id')->references('id')->on('mode_ventes');
            $table->foreign('unite_id')->references('id')->on('unites');
            //$table->foreign('preparation_type_id')->references('id')->on('preparation_types');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
