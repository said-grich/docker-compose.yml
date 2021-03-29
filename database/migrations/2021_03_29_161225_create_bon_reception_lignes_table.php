<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonReceptionLignesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_reception_lignes', function (Blueprint $table) {
            $table->id();
            $table->integer('qte');
            $table->decimal('prix_achat');
            $table->decimal('montant');

            $table->unsignedBigInteger('produit_id');
            $table->foreign('produit_id')->references('id')->on('produits');
            $table->string('bon_reception_ref');
            $table->foreign('bon_reception_ref')->references('ref')->on('bon_receptions');
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
        Schema::dropIfExists('bon_reception_lignes');
    }
}
