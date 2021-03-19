
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->string('code');
        $table->string('code_fournisseur')->nullable();
        $table->string('libelle');
        //$table->string('designation');
        $table->foreignId('famille_id');
        $table->foreignId('sous_famille_id')->nullable();
        $table->json('fournisseur_id');
        $table->string('marque')->nullable();
        $table->string('code_comptable');
        $table->string('assujetti_tva');
        $table->integer('tva')->nullable();
        $table->integer('qte_minimum');
        $table->integer('qte_securite');
        $table->foreignId('unite_achat_id');
        $table->foreignId('unite_vente_id');
        $table->foreignId('unite_affichee_id');
        $table->integer('interdire_achat')->nullable();
        $table->integer('interdire_vente')->nullable();
        $table->integer('montage')->nullable();
        $table->integer('garantie_fournisseur')->nullable();
        $table->integer('garantie_client')->nullable();
        $table->integer('accepter_stock_negatif')->nullable();
        $table->string('nature')->nullable();
        $table->integer('plafond_remise')->nullable();
        $table->string('regle_sorties_stocks')->nullable();
        $table->string('type')->nullable();
        $table->integer('service')->nullable();
        $table->integer('cache')->nullable();
        $table->integer('marge')->nullable();
        $table->integer('peremption')->nullable();
        $table->date('date_peremption')->nullable();
        $table->integer('pmp')->nullable();
        $table->integer('taux_assurance')->nullable();
        $table->integer('frais_possession')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
