<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique();
            $table->date('date');
            $table->date('date_validite');
            $table->integer('validation');
            $table->foreignId('client_id');
            $table->integer('user_id');
            $table->foreignId('site_id');
            $table->integer('delai');
            $table->double('totalMt');
            $table->double('totalTva');
            $table->double('totalTtc');
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
        Schema::dropIfExists('devis');
    }
}
