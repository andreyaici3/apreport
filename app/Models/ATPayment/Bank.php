<?php

namespace App\Models\ATPayment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = "bank";
    protected $fillable = ["kode_bank", "nama_bank", "sisa_saldo", 'norek'];

    public function mutasi(){
        return $this->hasMany(MutasiBank::class, "id_bank");
    }
}
