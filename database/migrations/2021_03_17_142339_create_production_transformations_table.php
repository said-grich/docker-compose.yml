<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionTransformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_transformations', function (Blueprint $table) {
            $table->id();
            $table->date('date_reception');
            $table->foreignId('article_id');
            $table->foreignId('site_id');
            $table->string('lotmp');
            $table->foreignId('fournisseur_id');
            $table->decimal('qteinitial');
            $table->decimal('qte_apres_transformation');
            $table->decimal('nbheure_travail');
            $table->integer('CRR');
            $table->date('debut_tache');
            $table->date('fin_tache');
            $table->foreignId('productionoperation_id');
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
        Schema::dropIfExists('production_transformations');
    }
}
