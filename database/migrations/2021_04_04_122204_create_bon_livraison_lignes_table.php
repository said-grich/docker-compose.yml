<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonLivraisonLignesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_livraison_lignes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->float('qte');
            $table->double('prix');
            $table->double('montant');

            $table->string('bon_livraison_ref');
            $table->foreign('bon_livraison_ref')->references('ref')->on('bon_livraisons')->onUpdate('cascade')->onDelete('cascade');;
            $table->unsignedBigInteger('produit_id');
            $table->foreign('produit_id')->references('id')->on('produits');
            $table->unsignedBigInteger('categorie_id');
            $table->foreign('categorie_id')->references('id')->on('categories');

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
        Schema::dropIfExists('bon_livraison_lignes');
    }
}
