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
        Schema::create('GITable', function (Blueprint $table) {
            $table->id();
            $table->string('ID_FGI')->nullable();
            $table->string('Nama_GI')->nullable();
            $table->string('NamaSingkatan')->nullable();
            $table->string('KD_Pemilik')->nullable();
            $table->string('KD_Pengelola')->nullable();
            $table->string('tingkat_resiko')->nullable();
            $table->string('x')->nullable();
            $table->string('y')->nullable();
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
        Schema::dropIfExists('GITable');
    }
};
