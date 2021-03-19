<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonCommandeLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_commande_lines', function (Blueprint $table) {
            $table->id();
            $table->string('article_id');
            $table->string('libelle_article');
            $table->integer('qte_magasinier')->nullable();
            $table->integer('qte_a_commander');
            $table->float('prix');
            $table->foreignId('bon_commande_ref');
            $table->foreignId('fournisseur_id');
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
        Schema::dropIfExists('bon_commande_lines');
    }
}
