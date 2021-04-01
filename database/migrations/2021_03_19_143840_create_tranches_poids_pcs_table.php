<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranchesPoidsPcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tranches_poids_pcs', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('nom',80)->unique();
            $table->float('min_poids');
            $table->float('max_poids');
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
        Schema::dropIfExists('tranches_poids_pcs');
    }
}
