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
        Schema::create('bebanktt', function (Blueprint $table) {
            $table->id();
            $table->string('Pkey')->nullable();
            $table->string('Station')->nullable();
            $table->string('Nama')->nullable();
            $table->string('Daya')->nullable();
            $table->string('Alamat')->nullable();
            $table->string('Tanggal')->nullable();
            $table->string('CB')->nullable();
            $table->string('Meter')->nullable();
            $table->string('Status_Meter')->nullable();
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
        Schema::dropIfExists('bebanktt');
    }
};
