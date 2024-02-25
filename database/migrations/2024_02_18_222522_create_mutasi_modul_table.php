<?php

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
        Schema::create('mutasi_modul', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Modul::class, 'id_modul')->constrained('modul');
            $table->date("tanggal");
            $table->text("keterangan")->nullable();
            $table->double("jumlah")->default(0);
            
            $table->timestamps();
        });

        Schema::table('mutasi_bank', function(Blueprint $table){
            $table->foreignIdFor(MutasiModul::class, "id_mutasi_modul")->after('id_modul')->nullable()->constrained('mutasi_modul');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_modul');
    }
};
