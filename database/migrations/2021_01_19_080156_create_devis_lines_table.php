<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis_lines', function (Blueprint $table) {
            $table->id();
            $table->integer('devis_ref');
            $table->integer('article_id');
            $table->string('libelle_article');
            $table->integer('tva')->default(0);
            $table->integer('qte');
            $table->integer('prix');
            $table->integer('remise');
            $table->double('montant');
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
        Schema::dropIfExists('devis_lines');
    }
}
