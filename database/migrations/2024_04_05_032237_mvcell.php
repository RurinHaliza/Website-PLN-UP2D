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
        Schema::create('mvcell', function (Blueprint $table) {
            $table->id();
            $table->string('ID_CELL')->nullable();
            $table->string('ID_KELAS')->nullable();
            $table->string('LOKASI_PENEMPATAN')->nullable();
            $table->string('NAMA_JTM')->nullable();  
            $table->string('MERK')->nullable();
            $table->string('TYPE')->nullable();
            $table->string('NO_SERI')->nullable();
            $table->string('MERK_2')->nullable();
            $table->string('TYPE_2')->nullable();
            $table->string('NO_SERI_2')->nullable();
            $table->string('JENIS')->nullable();
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
        Schema::dropIfExists('mvcell');
    }
};
