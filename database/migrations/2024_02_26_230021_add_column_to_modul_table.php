<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('modul', function (Blueprint $table) {
            $table->string("ipcenter")->after("sisa_saldo")->nullable();
            $table->text("format_request")->after("ipcenter")->nullable();
            $table->text("format_response")->after("format_request")->nullable();
            $table->string("memberid")->after("format_response")->nullable();
            $table->string("pin")->after("memberid")->nullable();
            $table->string("password")->after("pin")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modul', function (Blueprint $table) {
            $table->dropColumn("ipcenter");
            $table->dropColumn("format_request");
            $table->dropColumn("format_response");
            $table->dropColumn("memberid");
            $table->dropColumn("pin");
            $table->dropColumn("password");
        });
    }
};
