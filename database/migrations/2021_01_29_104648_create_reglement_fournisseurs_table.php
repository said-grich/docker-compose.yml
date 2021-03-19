<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReglementFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reglement_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fournisseur_id');
            $table->foreignId('site_id');
            $table->foreignId('mode_paiement_id');
            $table->string('ref')->nullable();
            $table->integer('montant');
            $table->date('date_echeance')->nullable();
            $table->foreignId('compte_debiteur_id')->nullable();
            $table->foreignId('compte_crediteur_id')->nullable();
            $table->integer('remise')->nullable();
            //$table->integer('deuxime_mise');
            //$table->integer('impaye');
            $table->string('validation_paiement')->nullable();
            $table->date('date_encaissement')->nullable();
            $table->date('date_impaye')->nullable();
            $table->date('date_mise_banque')->nullable();
            $table->date('date_entree_feuille')->nullable();
            $table->foreignId('caisse_id')->nullable();
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
        Schema::dropIfExists('reglement_fournisseurs');
    }
}
