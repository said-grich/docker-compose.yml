<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_achats', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('ref')->unique();
            $table->integer('validation');
            $table->foreignId('user_id');
            $table->foreignId('depot_id');
            $table->foreignId('site_id');
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
        Schema::dropIfExists('demande_achats');
    }
}
