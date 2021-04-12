<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->decimal('seuil_commande');
            $table->decimal('seuil_livraison_gratuite');
            $table->decimal('frais_livraison');
            $table->time('heure', $precision = 0);
            $table->json('jours_livraison');
            // $table->boolean('lundi')->default(false);
            // $table->boolean('mardi')->default(false);
            // $table->boolean('mercredi')->default(false);
            // $table->boolean('jeudi')->default(false);
            // $table->boolean('vendredi')->default(false);
            // $table->boolean('samedi')->default(false);
            // $table->boolean('dimanche')->default(false);
            $table->boolean('active')->default(false);
            $table->unsignedBigInteger('ville_id');
            $table->foreign('ville_id')->references('id')->on('villes');
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
        Schema::dropIfExists('livraisons');
    }
}
