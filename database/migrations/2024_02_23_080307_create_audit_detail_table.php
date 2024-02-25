<?php

use App\Models\ATPayment\AuditMaster;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AuditMaster::class, "id_audit_master")->constrained('audit_master');
            $table->string("name");
            $table->timestamps();
        });

        Schema::table('mutasi_bank', function (Blueprint $table) {
            $table->foreign('id_detail_audit')->references('id')->on('audit_detail')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_detail');
        Schema::table('mutasi_bank', function (Blueprint $table) {
            $table->dropForeign('id_detail_audit');
        });
    }
};
