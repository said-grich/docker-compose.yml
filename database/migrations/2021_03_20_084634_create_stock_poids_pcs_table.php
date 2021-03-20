<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPoidsPcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_poids_pcs', function (Blueprint $table) {
            $table->id();
            $table->integer('qte');
            $table->double('prix_achat');
            $table->string('code');
            $table->double('poids');
            $table->double('cr');
            $table->double('prix_n');
            $table->double('prix_f');
            $table->double('prix_p');
            $table->string('br_num');

            $table->unsignedBigInteger('lot_id');
            $table->foreign('lot_id')->references('id')->on('lots');

            $table->unsignedBigInteger('tranche_id');
            $table->foreign('tranche_id')->references('id')->on('tranches_poids_pcs');

            $table->unsignedBigInteger('depot_id');
            $table->foreign('depot_id')->references('id')->on('depots');

            $table->unsignedBigInteger('promo_id');
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
        Schema::dropIfExists('stock_poids_pcs');
    }
}
