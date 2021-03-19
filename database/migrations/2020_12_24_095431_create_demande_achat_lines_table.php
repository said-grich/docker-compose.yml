<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeAchatLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_achat_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_achat_ref');
            $table->string('article_id');
            $table->string('libelle_article');
            $table->integer('qte');
            $table->integer('mod');
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
        Schema::dropIfExists('demande_achat_lines');
    }
}
