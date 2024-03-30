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
        Schema::create('Trafo', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_GI')->nullable();
            $table->string('TRAFO')->nullable();
            $table->string('ID_TRAFO')->nullable();
            $table->string('ID_KELAS')->nullable();
            $table->string('KD_PEMILIK')->nullable();
            $table->string('KD_PENGELOLA')->nullable();
            $table->string('TINGKAT_RESIKO')->nullable();
            $table->string('KODE_PERALATAN')->nullable();
            $table->string('MERK')->nullable();
            $table->string('NO_SERI')->nullable();
            $table->string('PERUNTUKAN')->nullable();
            $table->string('JENIS')->nullable();
            $table->string('STATUS')->nullable();
            $table->string('TGL_PASANG')->nullable();
            $table->string('TGL_OPERASI')->nullable();
            $table->string('NILAI_PEROLEHAN')->nullable();
            $table->string('NILAI_BUKU')->nullable();
            $table->string('UMUR_EKONOMIS')->nullable();
            $table->string('UMUR_MANFAAT')->nullable();
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
        Schema::dropIfExists('Trafo');
    }
};
