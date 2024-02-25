<?php

namespace App\Models\ATPayment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitorModul extends Model
{
    use HasFactory;
    protected $table = "monitor_modul";
    protected $fillable = ["id_modul", "tanggal", "saldo_awal", "penambahan_saldo", "sisa_saldo", "pembelian_oto", "penjualan_oto"];
}
