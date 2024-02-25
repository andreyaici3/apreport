<?php

namespace App\Models\ATPayment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositOtomax extends Model
{
    use HasFactory;

    protected $table = "deposit_otomax";
    protected $fillable = ["tanggal", "nominal"];

    public function mutasibank(){
        return $this->hasMany(MutasiBank::class, 'tanggal', 'tanggal');
    }

    public function deposit_kredit()
    {
        return $this->hasMany(DepositKredit::class, 'tanggal', 'tanggal');
    }
}
