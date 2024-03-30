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
        Schema::create('Penyulang', function (Blueprint $table) {
            $table->id();
            $table->string('ID_JTM')->nullable();
            $table->string('ID_GI')->nullable();
            $table->string('ID_TRAFOGI')->nullable();
            $table->string('NM_JTM')->nullable();
            $table->string('NM_GI')->nullable();
            $table->string('NM_SINGKATAN')->nullable();
            $table->string('UP3')->nullable();
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
        Schema::dropIfExists('Penyulang');
    }
};
