<?php

namespace App\Models\ATPayment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;
    protected $table = "modul";
    protected $fillable = ['kode_modul', 'nama_modul', 'sisa_saldo'];

    public function mutasi(){
        return $this->hasMany(MutasiModul::class, 'id_modul')->orderBy('tanggal', 'ASC');
    }

    public function monitor(){
        return $this->hasMany(MonitorModul::class, 'id_modul')->orderBy('tanggal', 'ASC');
    }
}
