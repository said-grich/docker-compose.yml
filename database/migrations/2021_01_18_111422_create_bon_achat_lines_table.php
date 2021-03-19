<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonAchatLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_achat_lines', function (Blueprint $table) {
            $table->id();
            $table->string('article_id');
            $table->string('libelle_article');
            $table->string('num_lot', 15);
            $table->integer('qte');
            $table->float('prix_achat');
            $table->integer('taux_tva');
            $table->float('montant');
            $table->float('montant_tva');
            $table->foreignId('bon_achat_ref');
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
        Schema::dropIfExists('bon_achat_lines');
    }
}
