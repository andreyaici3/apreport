<?php

use App\Models\ATPayment\Bank;
use App\Models\ATPayment\Modul;
use App\Models\ATPayment\MutasiModul;
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
        Schema::create('mutasi_bank', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bank::class, "id_bank")->nullable()->constrained("bank");
            $table->text("keterangan")->nullable();
            $table->date("tanggal");
            $table->enum("tipe", ['credit', 'debit']);
            $table->double("amount");
            $table->boolean("deposit_rs")->default(false);
            $table->boolean("deposit_spl")->default(false);
            $table->foreignIdFor(Modul::class, "id_modul")->nullable()->constrained("modul");
            $table->unsignedBigInteger("id_detail_audit")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_bank');
    }
};
