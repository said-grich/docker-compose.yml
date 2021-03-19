<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonLivraisonLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_livraison_lines', function (Blueprint $table) {
            $table->id();
            $table->string('bon_livraison_ref');
            $table->integer('article_id');
            $table->string('libelle_article');
            $table->integer('qte');
            $table->integer('prix');
            $table->integer('tva')->default(0);
            $table->integer('montant');
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
        Schema::dropIfExists('bon_livraison_lines');
    }
}
