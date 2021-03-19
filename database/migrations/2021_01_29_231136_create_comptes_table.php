<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type_compte');
            $table->string('devise');
            $table->string('etat');
            $table->string('pays_compte');
            $table->date('date');
            $table->string('name_banque');
            $table->string('code_comptable');
            $table->string('num_compte');
            $table->foreignId('site_id');
            $table->string('swift');
            $table->foreignId('compte_comptable_id');
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
        Schema::dropIfExists('comptes');
    }
}
