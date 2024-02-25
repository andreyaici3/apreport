<?php

namespace App\Models\ATPayment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiBank extends Model
{
    use HasFactory;

    protected $table = "mutasi_bank";
    protected $fillable = ["id_bank", "keterangan", "tanggal", "tipe", "amount", "deposit_rs", "deposit_spl", "id_modul", 'id_mutasi_modul', 'audit', 'id_detail_audit'];

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'id_bank');
    }

    public function audit_detail()
    {
        return $this->belongsTo(AuditDetail::class, 'id_detail_audit');
    }
}
