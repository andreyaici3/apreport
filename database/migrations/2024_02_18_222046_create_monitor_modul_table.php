<?php

use App\Models\ATPayment\Modul;
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
        Schema::create('monitor_modul', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Modul::class, 'id_modul')->constrained('modul');
            $table->date("tanggal");
            $table->double("saldo_awal")->default(0);
            $table->double("penambahan_saldo")->default(0);
            $table->double("sisa_saldo")->default(0);
            $table->double("pembelian_oto")->default(0);
            $table->double("penjualan_oto")->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monitor_modul');
    }
};
