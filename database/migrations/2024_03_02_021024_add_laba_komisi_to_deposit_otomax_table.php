<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deposit_otomax', function (Blueprint $table) {
            $table->double("komisi")->after("nominal")->nullable();
            $table->double("laba")->after("komisi")->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('deposit_otomax', function (Blueprint $table) {
            $table->dropColumn('laba');
            $table->dropColumn('komisi');
        });
    }
};
