<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique();
            $table->macAddress('mac_address');
            $table->date('date');
            $table->date('date_livraison');
            $table->string('tel_livraison');
            $table->string('contact_livraison');
            $table->string('adresse_livraison');
            //$table->enum('etat', ['Validée,'Prête,'En Expédition','Livrée']);
            $table->string('etat');
            $table->decimal('frais_livraison');
            $table->decimal('total');

            $table->unsignedBigInteger('mode_livraison_id');
            $table->unsignedBigInteger('mode_paiement_id');
            //$table->unsignedBigInteger('ville_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('ville_quartie_id');
            $table->unsignedBigInteger('livreur_id');

            $table->foreign('mode_livraison_id')->references('id')->on('mode_livraisons');
            $table->foreign('mode_paiement_id')->references('id')->on('mode_paiements');
        /* $table->foreign('ville_id')->references('id')->on('villes');
            $table->foreign('ville_zone_id')->references('id')->on('ville_zones'); */
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('ville_quartie_id')->references('id')->on('ville_quartiers');
            $table->foreign('livreur_id')->references('id')->on('livreurs');


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
        Schema::dropIfExists('commandes');
    }
}
