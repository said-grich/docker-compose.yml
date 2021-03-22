<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVilleQuartiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ville_quartiers', function (Blueprint $table) {
            $table->id();
            $table->string('nom',80);
            $table->unsignedBigInteger('ville_zone_id');
            $table->foreign('ville_zone_id')->references('id')->on('ville_zones');
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
        Schema::dropIfExists('ville_quartiers');
    }
}
