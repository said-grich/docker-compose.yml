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
            //$table->string('code')->unique();
            $table->string('num_lot');
            $table->integer('qte');
            $table->integer('prix_achat');
            $table->float('prix_plus_charges_directes')->nullable();
            $table->float('prix_vente')->nullable();
            $table->foreignId('article_id');
            $table->foreignId('depot_id');
            $table->foreignId('site_id');
            $table->foreignId('bon_reception_id');
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
