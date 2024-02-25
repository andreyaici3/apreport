<?php

namespace Database\Seeders;

use App\Models\ATPayment\AuditDetail;
use App\Models\ATPayment\AuditMaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                "name" => 'Pengeluaran'                
            ],
            [
                "name" => "Pemasukan"
            ]
        ])->each(function($audit){
            AuditMaster::create($audit);
        });

        collect([
            [
                "id_audit_master" => 1,
                "name" => "Mutasi Ke Bank Lain"
            ],
            [
                "id_audit_master" => 1,
                "name" => "Administrasi Bank"
            ],
            [
                "id_audit_master" => 1,
                "name" => "Operasional"
            ],
            [
                "id_audit_master" => 1,
                "name" => "Marketing"
            ],
            [
                "id_audit_master" => 1,
                "name" => "Gaji Karyawan"
            ],
            [
                "id_audit_master" => 1,
                "name" => "Uang Makan Karyawan"
            ],
            [
                "id_audit_master" => 2,
                "name" => "Laba Serpul Harian"
            ],
            [
                "id_audit_master" => 2,
                "name" => "Mutasi Masuk"
            ],
            [
                "id_audit_master" => 2,
                "name" => "Bunga Bank"
            ],
        ])->each(function($detail){
            AuditDetail::create($detail);
        });
    }
}
