<?php

namespace App\Models\ATPayment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditDetail extends Model
{
    use HasFactory;

    protected $table = "audit_detail";

    protected $fillable = ["id_audit_master", "name"];
}
