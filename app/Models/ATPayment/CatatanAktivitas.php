<?php

namespace App\Models\ATPayment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanAktivitas extends Model
{
    use HasFactory;
    protected $table = "catatan_aktivitas";
    protected $fillable = ["log"];
}
