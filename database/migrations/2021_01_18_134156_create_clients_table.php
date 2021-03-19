<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {

            $table->id();
            $table->integer('user_id');
            // $table->integer('site_id');
            $table->string('name');
            $table->string('langue');
            $table->date('date_inscription');
            $table->date('date_deconnexion')->nullable();
            $table->string('industrie');
            $table->string('statut')->default('lead');
            $table->string('interne')->default(false);
            $table->foreignId('site_id')->nullable();

            $table->string('agent_nom');
            $table->string('agent_prenom');
            $table->string('tele_agent')->nullable();
            $table->string('genre_agent');
            $table->string('email_agent');
            $table->string('poste_agent');

            $table->string('address_livraison')->nullable();
            $table->string('code_postal_livraison')->nullable();
            $table->string('ville_livraison')->nullable();
            $table->string('province_livraison')->nullable();
            $table->string('pays_livraison')->nullable();

            $table->string('address_facturation')->nullable();
            $table->string('code_postal_facturation')->nullable();
            $table->string('ville_facturation')->nullable();
            $table->string('province_facturation')->nullable();
            $table->string('pays_facturation')->nullable();

            $table->text('comment_nous_trouve')->nullable();
            $table->string('recommandateur')->nullable();

            $table->string('tele_professionnel');
            $table->string('tele_portable')->nullable();
            $table->string('fax')->nullable();
            $table->string('email');
            $table->string('site_internet')->nullable();
            $table->string('linkedin')->nullable();

            $table->string('devise')->nullable();
            $table->string('mode_paiement')->nullable();
            $table->string('capitale')->nullable();
            $table->string('main_oeuvre')->nullable();
            $table->integer('taxe_utilisee')->nullable();
            $table->string('revenue_entreprise')->nullable();
            $table->decimal('montant_total',9,2)->nullable();
            $table->json('tags')->nullable();

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
        Schema::dropIfExists('clients');
    }
}
