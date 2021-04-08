<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depots', function (Blueprint $table) {
            $table->id();
            $table->string('nom',80);
            $table->integer('order_priorite');

            $table->unsignedBigInteger('ville_id');
            $table->foreign('ville_id')->references('id')->on('villes');

            $table->unsignedBigInteger('zone_id');
            $table->foreign('zone_id')->references('id')->on('ville_zones');
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
        Schema::dropIfExists('depots');
    }
}
