<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('data_bebanrst_max', function (Blueprint $table) {
            $table->string('name', 100)->nullable()->after('up3');
        });
    }

    public function down(): void
    {
        Schema::table('data_bebanrst_max', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
};