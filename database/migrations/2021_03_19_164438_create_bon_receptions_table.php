<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonReceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_receptions', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique();
            $table->date('date');
            $table->boolean('valide')->default(false);
            //$table->decimal('total')->nullable();

            $table->unsignedBigInteger('qualite_id');
            $table->foreign('qualite_id')->references('id')->on('qualites');
            $table->unsignedBigInteger('depot_id');
            $table->foreign('depot_id')->references('id')->on('depots');
            $table->unsignedBigInteger('fournisseur_id');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs');

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
        Schema::dropIfExists('bon_receptions');
    }
}
