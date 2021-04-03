<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockKgPcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_kg_pcs', function (Blueprint $table) {
            $table->id();
            $table->integer('qte');
            $table->double('prix_achat');
            $table->double('cr');
            $table->double('prix_n');
            $table->double('prix_f');
            $table->double('prix_p');
            $table->string('br_num');
            $table->decimal('pas');

            $table->string('lot_num');
            //$table->foreign('lot_num')->references('lot_num')->on('lots');

            $table->string('tranche_id');
            //$table->foreign('tranche_id')->references('id')->on('tranches');
            $table->foreign('tranche_id')->references('uid')->on('tranches_kg_pcs');

            $table->unsignedBigInteger('unite_id');
            $table->foreign('unite_id')->references('id')->on('unites');

            $table->unsignedBigInteger('produit_id');
            $table->foreign('produit_id')->references('id')->on('produits');

            $table->unsignedBigInteger('depot_id');
            $table->foreign('depot_id')->references('id')->on('depots');

            $table->unsignedBigInteger('sous_categorie_id');
            $table->unsignedBigInteger('categorie_id');

            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->foreign('sous_categorie_id')->references('id')->on('sous_categories');

            $table->unsignedBigInteger('promo_id')->nullable();
            $table->foreign('promo_id')->references('id')->on('promos');
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
        Schema::dropIfExists('stock_kg_pcs');
    }
}
