<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_achats', function (Blueprint $table) {
            $table->id();
            $table->integer('ref')->unique();
            $table->date('date');
            //$table->date('date_validite');
            $table->date('date_bl_fournisseur');
            //$table->integer('num_lot');
            //$table->integer('type');
            $table->boolean('validation')->default(false);
            $table->foreignId('depot_id');
            $table->foreignId('fournisseur_id');
            $table->foreignId('site_id');
            //$table->foreignId('client_id');
            $table->foreignId('user_id');
            //$table->foreignId('commercial_id');
            $table->float('total_ht')->nullable();
            $table->float('total_tva')->nullable();
            $table->float('total_ttc')->nullable();

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
        Schema::dropIfExists('bon_achats');
    }
}
