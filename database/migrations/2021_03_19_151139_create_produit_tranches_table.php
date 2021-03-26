<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitTranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_tranches', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('tranche_id');
            $table->unsignedBigInteger('produit_id');
            $table->string('tranche_id');

            $table->foreign('produit_id')->references('id')->on('produits');
            //$table->foreign('tranche_id')->references('id')->on('tranches');
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
        Schema::dropIfExists('produit_tranches');
    }
}
