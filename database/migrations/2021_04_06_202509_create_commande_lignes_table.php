<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeLignesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_lignes', function (Blueprint $table) {
            $table->id();
            $table->integer('qte');
            $table->decimal('prix');
            $table->decimal('montant');

            $table->string('commande_ref');
            $table->foreign('commande_ref')->references('ref')->on('commandes')->onUpdate('cascade')->onDelete('cascade');;

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
        Schema::dropIfExists('commande_lignes');
    }
}
