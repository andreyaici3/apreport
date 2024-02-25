<?php

namespace App\Models\ATPayment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditMaster extends Model
{
    use HasFactory;

    protected $table = "audit_master";

    protected $fillable = ["name"];

    public function detail(){
        return $this->hasMany(AuditDetail::class, 'id_audit_master');
    }
}
