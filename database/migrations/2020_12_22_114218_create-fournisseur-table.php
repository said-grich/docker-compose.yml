<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('tel');
            //$table->string('ville');
            $table->string('contact');
           /*  $table->string('adresse');
            $table->string('code_comptable')->nullable();
            $table->string('designation', 150);
            $table->bigInteger('ice');
            $table->bigInteger('idFiscal');
            $table->string('code_postal')->nullable();
            $table->string('ville');
            $table->string('pays');
            $table->string('region')->nullable(); */

            /* $table->integer('telephone_fixe');
            $table->string('fax')->nullable();
            $table->string('email');
            $table->foreignId('mode_paiement_id'); */

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
        Schema::dropIfExists('fournisseurs');
    }
}
