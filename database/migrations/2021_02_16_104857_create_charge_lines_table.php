<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargeLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_lines', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('num_facture');
            $table->string('libelle');
            $table->json('montant_ht');
            $table->json('ventilation')->nullable();
            $table->json('montant_tva');
            $table->json('montant_ttc');
            $table->foreignId('fournisseur_id');
            $table->foreignId('compte_comptable_fournisseur_id');
            $table->json('compte_comptable_ht_id')->nullable();
            $table->json('compte_comptable_Tva_id')->nullable();
            $table->foreignId('charge_ref');
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
        Schema::dropIfExists('charge_lines');
    }
}
