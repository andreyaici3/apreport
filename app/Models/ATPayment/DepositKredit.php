<?php

namespace App\Models\ATPayment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositKredit extends Model
{
    use HasFactory;

    protected $table = "deposit_kredit";
    protected $fillable = ["tanggal", "id_agen", "nominal"];
}
