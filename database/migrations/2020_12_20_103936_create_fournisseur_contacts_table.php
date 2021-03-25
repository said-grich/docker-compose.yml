<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseurContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseur_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('tel');
            $table->string('fonction');

            /* $table->unsignedBigInteger('fournissuer_id');
            $table->foreign('fournissuer_id')->references('id')->on('fournissuers'); */

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
        Schema::dropIfExists('fournisseur_contacts');
    }
}
