<?php

namespace App\Models\ATPayment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiModul extends Model
{
    use HasFactory;

    protected $table = "mutasi_modul";
    protected $fillable = ["id_modul", "tanggal", "keterangan", "jumlah"];
}
