<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tranches', function (Blueprint $table) {
            $table->id();
            $table->string('nom',80)->unique();
            $table->string('uid')->unique()->onUpdate('cascade')->onDelete('casacade');
           // $table->string('type',80);
            $table->float('min_poids')->nullable();
            $table->float('max_poids')->nullable();
            $table->unsignedBigInteger('mode_vente_id');
            $table->foreign('mode_vente_id')->references('id')->on('categories')/* ->onDelete('cascade') */;
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
        Schema::dropIfExists('tranches');
    }
}
