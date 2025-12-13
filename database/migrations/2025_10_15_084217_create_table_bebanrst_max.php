<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data_bebanrst_max', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('jenis_feeder', ['incoming', 'non_incoming']);
            $table->string('feeder_asal', 100)->nullable();
            $table->string('gardu_induk', 100)->nullable();
            $table->string('up3', 100)->nullable();
            $table->float('nilai_max')->nullable();
            $table->string('waktu_max', 10)->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->unique(['tanggal', 'jenis_feeder'], 'unique_per_day');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_bebanrst_max');
    }
};
