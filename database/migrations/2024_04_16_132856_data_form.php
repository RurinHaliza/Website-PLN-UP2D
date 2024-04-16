<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DataForm', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gi')->nullable();
            $table->integer('no_trafo')->nullable();
            $table->integer('primer')->nullable();
            $table->integer('sekunder')->nullable();
            $table->integer('daya')->nullable();
            $table->integer('panjang')->nullable();
            $table->string('penyulang')->nullable();
            $table->integer('inom')->nullable();
            $table->integer('iset')->nullable();
            $table->string('up3')->nullable();
            $table->integer('tertinggi_siang')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('tertinggi_malam')->nullable();
            $table->integer('rata_siang')->nullable();
            $table->integer('rata_malam')->nullable();
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
        Schema::dropIfExists('DataForm');
    }
};
