<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');
            $table->enum('sexe', ['h', 'f']);
            $table->date('date_naissance');
            $table->date('date_embauche');
            $table->enum('situation_familiale', ['m', 'c', 'd']);
            $table->integer('nombre_enfant');
            $table->string('qualification');
            $table->integer('num_cnss');
            $table->integer('num_cimr');
            $table->integer('credit_logement');
            $table->integer('jours_declare');
            $table->integer('salaire_base');
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
        Schema::dropIfExists('employes');
    }
}
