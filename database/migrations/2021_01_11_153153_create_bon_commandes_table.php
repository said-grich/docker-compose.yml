<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_commandes', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique();
            $table->date('date');
            $table->integer('validation');
            $table->foreignId('demande_achat_ref');
            $table->foreignId('fournisseur_id');
            $table->foreignId('user_id');
            $table->foreignId('mode_paiement_id');
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
        Schema::dropIfExists('bon_commandes');
    }
}
